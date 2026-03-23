<?php

use Illuminate\Support\Facades\Route;
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