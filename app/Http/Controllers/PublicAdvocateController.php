<?php

namespace App\Http\Controllers;

use App\Models\Advocate;
use App\Models\BarAssociation;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class PublicAdvocateController extends Controller
{
    /**
     * Display a listing of advocates for public search
     */
    public function index(Request $request)
    {
        $query = QueryBuilder::for(Advocate::class)
            ->where('is_active', true)
            ->with('barAssociation');

        // Global search - searches across multiple fields
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('email_address', 'like', "%{$searchTerm}%")
                    ->orWhere('mobile_no', 'like', "%{$searchTerm}%")
                    ->orWhere('father_husband_name', 'like', "%{$searchTerm}%");
            });
        }

        $query->allowedFilters([
            AllowedFilter::partial('name'),
            AllowedFilter::partial('email_address'),
            AllowedFilter::partial('mobile_no'),
            AllowedFilter::partial('father_husband_name'),
            AllowedFilter::exact('bar_association_id'),
            AllowedFilter::partial('visitor_member_of_bar_association'),
            AllowedFilter::partial('voter_member_of_bar_association'),
            AllowedFilter::partial('permanent_member_of_bar_association'),
        ])
            ->allowedSorts([
                AllowedSort::field('name'),
                AllowedSort::field('email_address'),
                AllowedSort::field('mobile_no'),
                AllowedSort::field('created_at'),
            ]);

        // Only paginate if there's a search or filter
        $hasSearch = $request->filled('search') || $request->filled('filter');

        if ($hasSearch) {
            $advocates = $query->paginate(15);

            // Append all current request parameters except 'page' to pagination links
            $advocates->appends($request->except('page'));
        } else {
            $advocates = collect();
        }

        $barAssociations = BarAssociation::where('is_active', true)->orderBy('name')->get();

        return view('public.advocates.index', compact('advocates', 'barAssociations', 'hasSearch'));
    }

    /**
     * Display the specified advocate (public view only)
     */
    public function show(Advocate $advocate)
    {
        // Only show if active
        if (!$advocate->is_active) {
            abort(404);
        }

        return view('public.advocates.show', compact('advocate'));
    }
}
