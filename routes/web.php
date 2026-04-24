<?php

use Illuminate\Support\Facades\Route;
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
