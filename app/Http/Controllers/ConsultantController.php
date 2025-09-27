<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use App\Services\ConsultantService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ConsultantController extends Controller
{
    protected ConsultantService $consultantService;

    public function __construct(ConsultantService $consultantService)
    {
        $this->consultantService = $consultantService;
    }

    /**
     * Display the main consultant analytics dashboard
     */
    public function index(): Response
    {
        return Inertia::render('Dashboard', [
            'consultants' => $this->consultantService->getActiveConsultants(),
            'clients' => app(ClientService::class)->getActiveClients(),
            'initialData' => [
                'tableData' => [],
                'chartData' => null,
                'pieChartData' => null,
                'dashboardStats' => null,
            ],
        ]);
    }

    /**
     * Get list of active consultants
     */
    public function getActiveConsultants()
    {
        return response()->json([
            'success' => true,
            'data' => $this->consultantService->getActiveConsultants(),
        ]);
    }

    /**
     * Get consultant report data
     */
    public function getReport(Request $request)
    {
        $consultantIds = $request->input('consultant_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : null;
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : null;

        $report = $this->consultantService->getConsultantReport($consultantIds, $dateFrom, $dateTo);

        return response()->json([
            'success' => true,
            'data' => $report,
            'filters' => [
                'consultant_ids' => $consultantIds,
                'date_from' => $dateFrom?->format('Y-m-d'),
                'date_to' => $dateTo?->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Get consultant chart data
     */
    public function getChartData(Request $request)
    {
        $consultantIds = $request->input('consultant_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : null;
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : null;

        $chartData = $this->consultantService->getConsultantChart($consultantIds, $dateFrom, $dateTo);

        return response()->json([
            'success' => true,
            'data' => $chartData,
            'filters' => [
                'consultant_ids' => $consultantIds,
                'date_from' => $dateFrom?->format('Y-m-d'),
                'date_to' => $dateTo?->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Get consultant pie chart data
     */
    public function getPieChartData(Request $request)
    {
        $consultantIds = $request->input('consultant_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : null;
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : null;

        $pieData = $this->consultantService->getConsultantPieChart($consultantIds, $dateFrom, $dateTo);

        return response()->json([
            'success' => true,
            'data' => $pieData,
            'filters' => [
                'consultant_ids' => $consultantIds,
                'date_from' => $dateFrom?->format('Y-m-d'),
                'date_to' => $dateTo?->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Get general consultant statistics
     */
    public function getStats(Request $request)
    {
        $consultantIds = $request->input('consultant_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : null;
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : null;

        $stats = $this->consultantService->getConsultantStats($consultantIds, $dateFrom, $dateTo);

        return response()->json([
            'success' => true,
            'data' => $stats,
            'filters' => [
                'consultant_ids' => $consultantIds,
                'date_from' => $dateFrom?->format('Y-m-d'),
                'date_to' => $dateTo?->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Get all consultant data at once (for initial dashboard load)
     */
    public function getDashboardData(Request $request)
    {
        $consultantIds = $request->input('consultant_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : null;
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : null;

        return response()->json([
            'success' => true,
            'data' => [
                'consultants' => $this->consultantService->getActiveConsultants(),
                'report' => $this->consultantService->getConsultantReportByMonth($consultantIds, $dateFrom, $dateTo),
                'chart' => $this->consultantService->getConsultantChart($consultantIds, $dateFrom, $dateTo),
                'pieChart' => $this->consultantService->getConsultantPieChart($consultantIds, $dateFrom, $dateTo),
                'stats' => $this->consultantService->getConsultantStats($consultantIds, $dateFrom, $dateTo),
            ],
            'filters' => [
                'consultant_ids' => $consultantIds,
                'date_from' => $dateFrom?->format('Y-m-d'),
                'date_to' => $dateTo?->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Get dashboard page data for Inertia
     */
    public function getDashboardPageData(Request $request)
    {
        $consultantIds = $request->input('consultant_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : null;
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : null;

        $data = [
            'consultants' => $this->consultantService->getActiveConsultants(),
            'clients' => app(ClientService::class)->getActiveClients(),
            'initialData' => [
                'tableData' => [],
                'chartData' => null,
                'pieChartData' => null,
                'dashboardStats' => null,
            ],
        ];

        if (! empty($consultantIds)) {
            $data['initialData'] = [
                'tableData' => $this->consultantService->getConsultantReportByMonth($consultantIds, $dateFrom, $dateTo),
                'chartData' => $this->consultantService->getConsultantChart($consultantIds, $dateFrom, $dateTo),
                'pieChartData' => $this->consultantService->getConsultantPieChart($consultantIds, $dateFrom, $dateTo),
                'dashboardStats' => $this->consultantService->getConsultantStats($consultantIds, $dateFrom, $dateTo),
            ];
        }

        return Inertia::render('Dashboard', $data);
    }
}
