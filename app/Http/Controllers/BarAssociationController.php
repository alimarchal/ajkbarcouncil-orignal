<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BarAssociation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use App\Http\Requests\StoreBarAssociationRequest;
use App\Http\Requests\UpdateBarAssociationRequest;

/**
 * BarAssociationController handles CRUD operations for bar associations
 * Manages status tracking and secure access
 */
class BarAssociationController extends Controller
{
    /**
     * Display paginated list of bar associations with filtering capabilities
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Build query with filters using Spatie QueryBuilder
        $query = QueryBuilder::for(BarAssociation::class)
            ->allowedFilters([
                AllowedFilter::partial('name'),                    // Search by name
                AllowedFilter::exact('is_active'),                 // Filter by status
                AllowedFilter::exact('created_by'),                // Filter by creator
                AllowedFilter::exact('updated_by'),                // Filter by updater
                AllowedFilter::callback('date_from', function ($query, $value) {
                    $query->whereDate('created_at', '>=', $value);
                }),
                AllowedFilter::callback('date_to', function ($query, $value) {
                    $query->whereDate('created_at', '<=', $value);
                }),
                AllowedFilter::callback('show_deleted', function ($query, $value) {
                    if ($value == 1) {
                        $query->onlyTrashed();  // Show only deleted records
                    }
                })
            ])
            ->allowedSorts([
                AllowedSort::field('name'),
                AllowedSort::field('is_active'),
                AllowedSort::field('created_at'),
                AllowedSort::field('updated_at'),
            ])
            ->with([
                'createdByUser' => function ($query) {
                    $query->select('id', 'name', 'email');
                },
                'updatedByUser' => function ($query) {
                    $query->select('id', 'name', 'email');
                }
            ]);

        // Apply default "Active" filter if no filters are set
        if (!$request->has('filter')) {
            $query->where('is_active', true);
        }

        $barAssociations = $query->latest()                        // Order by newest first
            ->paginate(10);                                        // Paginate results

        // Get filter options for dropdowns
        $users = User::orderBy('name')->get();
        $statusOptions = [
            1 => 'Active',
            0 => 'Inactive'
        ];

        return view('bar-associations.index', compact('barAssociations', 'users', 'statusOptions'));
    }

    /**
     * Show form to create new bar association
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('bar-associations.create');
    }

    /**
     * Store new bar association
     * Uses transaction for data consistency
     * 
     * @param StoreBarAssociationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBarAssociationRequest $request)
    {
        // Start database transaction
        DB::beginTransaction();

        try {
            // Get validated data from form request
            $validated = $request->validated();

            // Create bar association record in database
            $barAssociation = BarAssociation::create($validated);

            // Commit transaction if everything successful
            DB::commit();

            return redirect()
                ->route('bar-associations.index')
                ->with('success', "Bar Association '{$barAssociation->name}' created successfully.");

        } catch (\Illuminate\Database\QueryException $e) {
            // Rollback transaction on database error
            DB::rollBack();

            // Handle duplicate name error
            if ($e->getCode() === '23000' && str_contains($e->getMessage(), 'name')) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'A bar association with this name already exists.');
            }

            // Log database errors for debugging
            Log::error('Database error creating bar association', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Database error occurred. Please try again.');

        } catch (\Exception $e) {
            // Rollback transaction on any other error
            DB::rollBack();

            Log::error('Error creating bar association', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create bar association. Please try again.');
        }
    }

    /**
     * Display the specified bar association
     * 
     * @param BarAssociation $barAssociation
     * @return \Illuminate\View\View
     */
    public function show(BarAssociation $barAssociation)
    {
        $barAssociation->load(['createdByUser', 'updatedByUser', 'advocates']);
        return view('bar-associations.show', compact('barAssociation'));
    }

    /**
     * Show form to edit existing bar association
     * 
     * @param BarAssociation $barAssociation
     * @return \Illuminate\View\View
     */
    public function edit(BarAssociation $barAssociation)
    {
        return view('bar-associations.edit', compact('barAssociation'));
    }

    /**
     * Update existing bar association
     * Uses transaction for data consistency
     * 
     * @param UpdateBarAssociationRequest $request
     * @param BarAssociation $barAssociation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBarAssociationRequest $request, BarAssociation $barAssociation)
    {
        // Start database transaction
        DB::beginTransaction();

        try {
            // Get validated data from form request
            $validated = $request->validated();

            // Update bar association record
            $isUpdated = $barAssociation->update($validated);

            // Check if any changes were actually made
            if (!$isUpdated) {
                DB::rollBack();
                return redirect()->back()
                    ->with('info', 'No changes were made.');
            }

            // Commit transaction if update successful
            DB::commit();

            return redirect()
                ->route('bar-associations.index')
                ->with('success', "Bar Association '{$barAssociation->name}' updated successfully.");

        } catch (\Illuminate\Database\QueryException $e) {
            // Rollback transaction on database error
            DB::rollBack();

            // Handle duplicate name error
            if ($e->getCode() === '23000' && str_contains($e->getMessage(), 'name')) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'A bar association with this name already exists.');
            }

            // Log database errors for debugging
            Log::error('Database error updating bar association', [
                'bar_association_id' => $barAssociation->id,
                'error' => $e->getMessage(),
                'user_id' => auth()->id()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Database error occurred. Please try again.');

        } catch (\Exception $e) {
            // Rollback transaction on any other error
            DB::rollBack();

            Log::error('Error updating bar association', [
                'bar_association_id' => $barAssociation->id,
                'error' => $e->getMessage(),
                'user_id' => auth()->id()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update bar association. Please try again.');
        }
    }

    /**
     * Delete (soft delete) the specified bar association
     * 
     * @param BarAssociation $barAssociation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BarAssociation $barAssociation)
    {
        DB::beginTransaction();

        try {
            $name = $barAssociation->name;
            $barAssociation->delete();

            DB::commit();

            return redirect()
                ->route('bar-associations.index')
                ->with('success', "Bar Association '{$name}' deleted successfully.");

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error deleting bar association', [
                'bar_association_id' => $barAssociation->id,
                'error' => $e->getMessage(),
                'user_id' => auth()->id()
            ]);

            return redirect()->back()
                ->with('error', 'Failed to delete bar association. Please try again.');
        }
    }

    /**
     * Restore a soft-deleted bar association
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        DB::beginTransaction();

        try {
            $barAssociation = BarAssociation::withTrashed()->findOrFail($id);
            $name = $barAssociation->name;
            $barAssociation->restore();

            DB::commit();

            return redirect()
                ->route('bar-associations.index')
                ->with('success', "Bar Association '{$name}' restored successfully.");

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error restoring bar association', [
                'bar_association_id' => $id,
                'error' => $e->getMessage(),
                'user_id' => auth()->id()
            ]);

            return redirect()->back()
                ->with('error', 'Failed to restore bar association. Please try again.');
        }
    }
}
