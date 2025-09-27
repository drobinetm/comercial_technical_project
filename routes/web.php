<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConsultantController;
use App\Services\ClientService;
use App\Services\ConsultantService;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Dashboard Home
Route::get('/', function () {
    return Inertia::render('Dashboard', [
        'consultants' => app(ConsultantService::class)->getActiveConsultants(),
        'clients' => app(ClientService::class)->getActiveClients(),
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
Route::get('/dashboard/client-data', [ClientController::class, 'getDashboardPageData'])->name('dashboard.client-data');


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

// Client Analytics Routes
Route::prefix('client-analytics')->name('client.')->group(function () {
    // Main dashboard page
    Route::get('/', [ClientController::class, 'index'])->name('dashboard');

    // API endpoints for client data fetching
    Route::get('/clients', [ClientController::class, 'getActiveClients'])->name('clients');
    Route::get('/report', [ClientController::class, 'getReport'])->name('report');
    Route::get('/chart-data', [ClientController::class, 'getChartData'])->name('chart');
    Route::get('/pie-chart-data', [ClientController::class, 'getPieChartData'])->name('pie');
    Route::get('/stats', [ClientController::class, 'getStats'])->name('stats');
    Route::get('/dashboard-data', [ClientController::class, 'getDashboardData'])->name('dashboard-data');
    Route::get('/performance-comparison', [ClientController::class, 'getPerformanceComparison'])->name('performance');
    Route::get('/summary', [ClientController::class, 'getDashboardSummary'])->name('summary');
    Route::post('/validate-ids', [ClientController::class, 'validateClientIds'])->name('validate');
});
