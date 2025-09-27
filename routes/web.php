<?php

use App\Services\ConsultantService;
use App\Http\Controllers\ConsultantController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Dashboard Home
Route::get('/', function () {
    return Inertia::render('Dashboard', [
        'consultants' => app(ConsultantService::class)->getActiveConsultants(),
        'initialData' => [
            'tableData' => [],
            'chartData' => null,
            'pieChartData' => null,
            'dashboardStats' => null,
        ],
    ]);
})->name('home');


// Dashboard data filtering routes
Route::get('/dashboard/consultant-data', [ConsultantController::class, 'getDashboardPageData'])->name('dashboard.consultant-data');


// Consultant Analytics Routes
Route::prefix('consultant-analytics')->name('consultant.')->group(function () {
    // Main dashboard page
    Route::get('/', [ConsultantController::class, 'index'])->name('dashboard');

    // API endpoints for data fetching
    Route::get('/consultants', [ConsultantController::class, 'getActiveConsultants'])->name('consultants');
    Route::get('/report', [ConsultantController::class, 'getReport'])->name('report');
    Route::get('/chart-data', [ConsultantController::class, 'getChartData'])->name('chart');
    Route::get('/pie-chart-data', [ConsultantController::class, 'getPieChartData'])->name('pie');
    Route::get('/stats', [ConsultantController::class, 'getStats'])->name('stats');
    Route::get('/dashboard-data', [ConsultantController::class, 'getDashboardData'])->name('dashboard-data');
});
