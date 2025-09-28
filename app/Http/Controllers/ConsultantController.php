<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use App\Services\ConsultantService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ConsultantController extends Controller
{
    protected ConsultantService $consultantService;

    public function __construct(ConsultantService $consultantService)
    {
        $this->consultantService = $consultantService;
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
