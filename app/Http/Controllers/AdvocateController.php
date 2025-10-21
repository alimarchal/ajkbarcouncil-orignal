<?php

namespace App\Http\Controllers;

use App\Models\Advocate;
use App\Models\BarAssociation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use App\Http\Requests\StoreAdvocateRequest;
use App\Http\Requests\UpdateAdvocateRequest;

class AdvocateController extends Controller
{
    public function index(Request $request)
    {
        $query = QueryBuilder::for(Advocate::class)
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::partial('email_address'),
                AllowedFilter::exact('is_active'),
                AllowedFilter::exact('bar_association_id'),
                AllowedFilter::callback('show_deleted', function ($query, $value) {
                    if ($value == 1) {
                        $query->onlyTrashed();
                    }
                })
            ])
            ->allowedSorts([
                AllowedSort::field('name'),
                AllowedSort::field('email_address'),
                AllowedSort::field('is_active'),
                AllowedSort::field('created_at'),
            ]);

        if (!$request->has('filter')) {
            $query->where('is_active', true);
        }

        $advocates = $query->paginate(15);
        $barAssociations = BarAssociation::where('is_active', true)->get();

        return view('advocates.index', compact('advocates', 'barAssociations'));
    }

    public function create()
    {
        $barAssociations = BarAssociation::where('is_active', true)->orderBy('name')->get();
        return view('advocates.create', compact('barAssociations'));
    }

    public function store(StoreAdvocateRequest $request)
    {
        DB::beginTransaction();

        try {
            $advocate = Advocate::create($request->validated());
            DB::commit();

            return redirect()->route('advocates.index')
                ->with('success', "Advocate '{$advocate->name}' created successfully.");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating advocate', ['error' => $e->getMessage(), 'user_id' => auth()->id()]);

            return redirect()->back()->withInput()
                ->with('error', 'Failed to create advocate. Please try again.');
        }
    }

    public function show(Advocate $advocate)
    {
        return view('advocates.show', compact('advocate'));
    }

    public function edit(Advocate $advocate)
    {
        $barAssociations = BarAssociation::orderBy('name')->get();
        return view('advocates.edit', compact('advocate', 'barAssociations'));
    }

    public function update(UpdateAdvocateRequest $request, Advocate $advocate)
    {
        DB::beginTransaction();

        try {
            $advocate->update($request->validated());
            DB::commit();

            return redirect()->route('advocates.index')
                ->with('success', "Advocate '{$advocate->name}' updated successfully.");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating advocate', ['advocate_id' => $advocate->id, 'error' => $e->getMessage(), 'user_id' => auth()->id()]);

            return redirect()->back()->withInput()
                ->with('error', 'Failed to update advocate. Please try again.');
        }
    }

    public function destroy(Advocate $advocate)
    {
        DB::beginTransaction();

        try {
            $name = $advocate->name;
            $advocate->delete();
            DB::commit();

            return redirect()->route('advocates.index')
                ->with('success', "Advocate '{$name}' deleted successfully.");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting advocate', ['advocate_id' => $advocate->id, 'error' => $e->getMessage(), 'user_id' => auth()->id()]);

            return redirect()->back()->with('error', 'Failed to delete advocate. Please try again.');
        }
    }

    public function restore($id)
    {
        DB::beginTransaction();

        try {
            $advocate = Advocate::withTrashed()->findOrFail($id);
            $name = $advocate->name;
            $advocate->restore();
            DB::commit();

            return redirect()->route('advocates.index')
                ->with('success', "Advocate '{$name}' restored successfully.");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error restoring advocate', ['advocate_id' => $id, 'error' => $e->getMessage(), 'user_id' => auth()->id()]);

            return redirect()->back()->with('error', 'Failed to restore advocate. Please try again.');
        }
    }
}
