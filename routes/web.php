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

Route::resource('players', PlayerController::class);

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