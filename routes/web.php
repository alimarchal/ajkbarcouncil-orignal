<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarAssociationController;
use App\Http\Controllers\AdvocateController;
use App\Http\Controllers\PublicAdvocateController;

// Route::get('/', function () {
//     return redirect()->route('advocates.public.index');
// });


Route::get('/', [PublicAdvocateController::class, 'index'])->name('homepage.index');
Route::get('advocates/{advocate}/view', [PublicAdvocateController::class, 'show'])->name('homepage.advocateShow');
// Public Routes (No Authentication Required)
// Route::prefix('public')->name('public.')->group(function () {

// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Bar Association Routes
    Route::resource('bar-associations', BarAssociationController::class);
    Route::patch('bar-associations/{id}/restore', [BarAssociationController::class, 'restore'])->name('bar-associations.restore');

    // Advocate Routes
    Route::get('advocates/report', [AdvocateController::class, 'report'])->name('advocates.report');
    Route::resource('advocates', AdvocateController::class);
    Route::patch('advocates/{id}/restore', [AdvocateController::class, 'restore'])->name('advocates.restore');
});
