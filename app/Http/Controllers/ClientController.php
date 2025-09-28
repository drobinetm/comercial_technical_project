<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use App\Services\ConsultantService;
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
     * Get dashboard page data for Inertia
     *
     * @return Response
     */
    public function getDashboardPageData(Request $request)
    {
        $clientIds = $request->input('client_ids', []);
        $dateFrom = $request->input('date_from') ? Carbon::parse($request->input('date_from')) : null;
        $dateTo = $request->input('date_to') ? Carbon::parse($request->input('date_to')) : null;

        $data = [
            'consultants' => app(ConsultantService::class)->getActiveConsultants(),
            'clients' => $this->clientService->getActiveClients(),
            'initialData' => [
                'tableData' => [],
                'chartData' => null,
                'pieChartData' => null,
                'dashboardStats' => null,
            ],
        ];

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
}
