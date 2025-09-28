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

// Health Check Route
Route::get('/health', function () {
    return response()->json(['OK']);
});
