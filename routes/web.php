<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarAssociationController;
use App\Http\Controllers\AdvocateController;

Route::get('/', function () {
    return view('welcome');
});

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
