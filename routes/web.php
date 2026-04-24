<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\FixtureController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('players', PlayerController::class);

Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
Route::get('/reports/create', [ReportsController::class, 'create'])->name('reports.create');
Route::post('/reports', [ReportsController::class, 'store'])->name('reports.store');

Route::get('/players/{player}/reports', [ReportsController::class, 'showByPlayer'])->name('players.reports');

Route::get('/reports/{report}', [ReportsController::class, 'show'])->name('reports.show');
Route::delete('/reports/{report}', [ReportsController::class, 'destroy'])->name('reports.destroy');

Route::resource('fixtures', FixtureController::class);
=======
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PlayerController;

// Homepage route (loads first)
Route::get('/', function () {
    return view('home'); // Your custom homepage
})->name('home'); // Useful for navbar links

// Search route: directs to a player by name
Route::get('/player-search', [PlayerController::class, 'search'])->name('players.search');

// Players resource routes
Route::resource('players', PlayerController::class);

// NEW: Route for Chart.js stats page (Step 4)
Route::get('/players-stats', [PlayerController::class, 'statsChart'])->name('players.stats');

// Database test route
Route::get('/db-test', function() {
    try {
        DB::connection()->getPdo();
        return 'Database is connected!';
    } catch (\Exception $e) {
        return 'Database connection failed: ' . $e->getMessage();
    }
});
>>>>>>> 9b886b4ec612b110d38c0bf916c63528599a5d4e
