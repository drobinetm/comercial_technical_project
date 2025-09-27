<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ClientController extends Controller
{
    protected ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Display the main client analytics dashboard
     */
    public function index(): Response
    {
        return Inertia::render('ClientAnalytics/Dashboard', [
            'activeClients' => $this->clientService->getActiveClients(),
            'initialData' => $this->getInitialDashboardData(),
        ]);
    }

    /**
     * Get list of active clients
     */
    public function getActiveClients()
    {
        return response()->json([
            'success' => true,
            'data' => $this->clientService->getActiveClients(),
        ]);
    }

    /**
     * Get client report data
     */
    public function getReport(Request $request)
    {
        $clientIds = $request->input('client_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : null;
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : null;

        $report = $this->clientService->getClientReportByMonth($clientIds, $dateFrom, $dateTo);

        return response()->json([
            'success' => true,
            'data' => $report,
            'filters' => [
                'client_ids' => $clientIds,
                'date_from' => $dateFrom?->format('Y-m-d'),
                'date_to' => $dateTo?->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Get client chart data
     */
    public function getChartData(Request $request)
    {
        $clientIds = $request->input('client_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : null;
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : null;

        $chartData = $this->clientService->getClientChart($clientIds, $dateFrom, $dateTo);

        return response()->json([
            'success' => true,
            'data' => $chartData,
            'filters' => [
                'client_ids' => $clientIds,
                'date_from' => $dateFrom?->format('Y-m-d'),
                'date_to' => $dateTo?->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Get client pie chart data
     */
    public function getPieChartData(Request $request)
    {
        $clientIds = $request->input('client_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : null;
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : null;

        $pieData = $this->clientService->getClientPieChart($clientIds, $dateFrom, $dateTo);

        return response()->json([
            'success' => true,
            'data' => $pieData,
            'filters' => [
                'client_ids' => $clientIds,
                'date_from' => $dateFrom?->format('Y-m-d'),
                'date_to' => $dateTo?->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Get general client statistics
     */
    public function getStats(Request $request)
    {
        $clientIds = $request->input('client_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : null;
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : null;

        $stats = $this->clientService->getClientStats($clientIds, $dateFrom, $dateTo);

        return response()->json([
            'success' => true,
            'data' => $stats,
            'filters' => [
                'client_ids' => $clientIds,
                'date_from' => $dateFrom?->format('Y-m-d'),
                'date_to' => $dateTo?->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Get all client data at once (for dashboard load)
     */
    public function getDashboardData(Request $request)
    {
        $clientIds = $request->input('client_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : null;
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : null;

        return response()->json([
            'success' => true,
            'data' => [
                'clients' => $this->clientService->getActiveClients(),
                'report' => $this->clientService->getClientReportByMonth($clientIds, $dateFrom, $dateTo),
                'chart' => $this->clientService->getClientChart($clientIds, $dateFrom, $dateTo),
                'pieChart' => $this->clientService->getClientPieChart($clientIds, $dateFrom, $dateTo),
                'stats' => $this->clientService->getClientStats($clientIds, $dateFrom, $dateTo),
            ],
            'filters' => [
                'client_ids' => $clientIds,
                'date_from' => $dateFrom?->format('Y-m-d'),
                'date_to' => $dateTo?->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Get client performance comparison
     */
    public function getPerformanceComparison(Request $request)
    {
        $clientIds = $request->input('client_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : Carbon::now()->startOfYear();
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : Carbon::now()->endOfYear();

        $comparison = $this->clientService->getClientPerformanceComparison($clientIds, $dateFrom, $dateTo);

        return response()->json([
            'success' => true,
            'data' => $comparison,
            'filters' => [
                'client_ids' => $clientIds,
                'date_from' => $dateFrom->format('Y-m-d'),
                'date_to' => $dateTo->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Get dashboard summary
     */
    public function getDashboardSummary(Request $request)
    {
        $clientIds = $request->input('client_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : Carbon::now()->startOfYear();
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : Carbon::now()->endOfYear();

        $summary = $this->clientService->getDashboardSummary($clientIds, $dateFrom, $dateTo);

        return response()->json([
            'success' => true,
            'data' => $summary,
            'filters' => [
                'client_ids' => $clientIds,
                'date_from' => $dateFrom->format('Y-m-d'),
                'date_to' => $dateTo->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Get dashboard page data for Inertia
     */
    public function getDashboardPageData(Request $request)
    {
        $clientIds = $request->input('client_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : null;
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : null;

        $data = [
            'consultants' => app(\App\Services\ConsultantService::class)->getActiveConsultants(),
            'clients' => $this->clientService->getActiveClients(),
            'initialData' => [
                'tableData' => [],
                'chartData' => null,
                'pieChartData' => null,
                'dashboardStats' => null,
            ],
        ];

        // If client IDs are provided, fetch the data
        if (! empty($clientIds)) {
            $data['initialData'] = [
                'tableData' => $this->clientService->getClientReportByMonth($clientIds, $dateFrom, $dateTo),
                'chartData' => $this->clientService->getClientChart($clientIds, $dateFrom, $dateTo),
                'pieChartData' => $this->clientService->getClientPieChart($clientIds, $dateFrom, $dateTo),
                'dashboardStats' => $this->clientService->getClientStats($clientIds, $dateFrom, $dateTo),
            ];
        }

        return Inertia::render('Dashboard', $data);
    }

    /**
     * Validate client IDs
     */
    public function validateClientIds(Request $request)
    {
        $clientIds = $request->input('client_ids', []);
        $validIds = $this->clientService->validateClientIds($clientIds);

        return response()->json([
            'success' => true,
            'data' => [
                'requested_ids' => $clientIds,
                'valid_ids' => $validIds,
                'invalid_ids' => array_diff($clientIds, $validIds),
            ],
        ]);
    }

    /**
     * Get initial dashboard data with default filters
     */
    private function getInitialDashboardData(): array
    {
        // Default to current year if no filters provided
        $dateFrom = Carbon::now()->startOfYear();
        $dateTo = Carbon::now()->endOfYear();

        return [
            'report' => [],  // Start with empty data until clients are selected
            'chart' => [
                'clients' => [],
                'chart_config' => [
                    'labels' => [],
                    'datasets' => [],
                ],
            ],
            'pieChart' => [
                'clients' => [],
                'chart_config' => [
                    'labels' => [],
                    'datasets' => [],
                ],
                'total_revenue' => 0,
            ],
            'stats' => [
                'total_clients' => 0,
                'total_net_revenue' => 0,
                'total_consultant_costs' => 0,
                'total_profit' => 0,
                'profit_margin_percentage' => 0,
            ],
        ];
    }
}
