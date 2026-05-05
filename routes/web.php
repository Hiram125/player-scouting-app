<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\CompareController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
Route::get('/players/create', [PlayerController::class, 'create'])->name('players.create');
Route::post('/players', [PlayerController::class, 'store'])->name('players.store');
Route::get('/players/{player}', [PlayerController::class, 'show'])->name('players.show');
Route::get('/players/{player}/edit', [PlayerController::class, 'edit'])->name('players.edit');
Route::put('/players/{player}', [PlayerController::class, 'update'])->name('players.update');

Route::get('/player-search', [PlayerController::class, 'search'])->name('players.search');
Route::get('/players-stats', [PlayerController::class, 'statsChart'])->name('players.stats');

Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
Route::get('/reports/create', [ReportsController::class, 'create'])->name('reports.create');
Route::post('/reports', [ReportsController::class, 'store'])->name('reports.store');

Route::get('/players/{player}/reports', [ReportsController::class, 'showByPlayer'])->name('players.reports');

Route::get('/reports/{report}', [ReportsController::class, 'show'])->name('reports.show');
Route::delete('/reports/{report}', [ReportsController::class, 'destroy'])->name('reports.destroy');

Route::resource('fixtures', FixtureController::class);

Route::get('/compare', [CompareController::class, 'index'])->name('compare.index');
Route::post('/compare', [CompareController::class, 'compare'])->name('compare.compare');

Route::get('/db-test', function () {
    try {
        DB::connection()->getPdo();
        return 'Database is connected!';
    } catch (\Exception $e) {
        return 'Database connection failed: ' . $e->getMessage();
    }
});