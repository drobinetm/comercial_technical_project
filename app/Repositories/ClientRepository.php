<?php

namespace App\Repositories;

use App\Contracts\IClientRepositoryInterface;
use App\Models\CaoClient;
use App\Models\CaoInvoice;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class ClientRepository implements IClientRepositoryInterface
{
    public function listActiveClients(): Collection
    {
        return CaoClient::whereNotNull('no_razao')
            ->where('no_razao', '!=', '')
            ->where('tp_cliente', '=', 'A')
            ->select(
                'co_cliente',
                'no_razao',
                'no_fantasia',
                'no_contato',
                'ds_email'
            )
            ->orderBy('no_razao')
            ->get();
    }

    public function getClientReport(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection
    {
        $report = collect();

        // Get filtered active clients
        $clientsQuery = $this->getFilteredClients($clientIds);
        $clients = $clientsQuery->get();

        foreach ($clients as $client) {
            $clientId = $client->{'co_cliente'};

            $netRevenue = $this->calculateClientNetRevenue($clientId, $dateFrom, $dateTo);
            $consultantCosts = $this->calculateConsultantCosts($clientId, $dateFrom, $dateTo);
            $profit = $netRevenue - $consultantCosts;

            $report->push([
                'co_cliente' => $clientId,
                'no_cliente' => $client->{'no_razao'} ?: $client->{'no_fantasia'},
                'net_revenue' => round($netRevenue, 2),
                'consultant_costs' => round($consultantCosts, 2),
                'profit' => round($profit, 2),
            ]);
        }

        return $report->sortByDesc('net_revenue');
    }

    public function getClientChart(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection
    {
        $chartData = collect();
        $totalCosts = 0;

        // Get filtered active clients
        $clientsQuery = $this->getFilteredClients($clientIds);
        $clients = $clientsQuery->get();
        $clientCount = $clients->count();

        foreach ($clients as $client) {
            $clientId = $client->{'co_cliente'};

            $netRevenue = $this->calculateClientNetRevenue($clientId, $dateFrom, $dateTo);
            $consultantCosts = $this->calculateConsultantCosts($clientId, $dateFrom, $dateTo);

            $profit = $netRevenue - $consultantCosts;
            $totalCosts += $consultantCosts;

            $chartData->push([
                'co_cliente' => $clientId,
                'no_cliente' => $client->{'no_razao'} ?: $client->{'no_fantasia'},
                'net_revenue' => round($netRevenue, 2),
                'consultant_costs' => round($consultantCosts, 2),
                'profit' => round($profit, 2),
            ]);
        }

        $averageCosts = $clientCount > 0 ? round($totalCosts / $clientCount, 2) : 0;
        $maxRevenue = $chartData->max('net_revenue');
        $maxValue = max($maxRevenue, $averageCosts) * 1.1;

        return collect([
            'data' => $chartData->sortByDesc('net_revenue')->values(),
            'average_consultant_costs' => $averageCosts,
            'max_axis_value' => round($maxValue),
        ]);
    }

    public function getClientPieChart(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection
    {
        $pieData = collect();
        $totalRevenue = 0;

        // Get filtered active clients
        $clientsQuery = $this->getFilteredClients($clientIds);
        $clients = $clientsQuery->get();

        foreach ($clients as $client) {
            $clientId = $client->{'co_cliente'};

            $netRevenue = $this->calculateClientNetRevenue($clientId, $dateFrom, $dateTo);

            $pieData->push([
                'co_cliente' => $clientId,
                'no_cliente' => $client->{'no_razao'} ?: $client->{'no_fantasia'},
                'net_revenue' => $netRevenue,
            ]);

            $totalRevenue += $netRevenue;
        }

        $pieData = $pieData->map(function ($item) use ($totalRevenue) {
            $percentage = $totalRevenue > 0 ? ($item['net_revenue'] / $totalRevenue) * 100 : 0;

            return [
                'co_cliente' => $item['co_cliente'],
                'no_cliente' => $item['no_cliente'],
                'net_revenue' => round($item['net_revenue'], 2),
                'percentage' => round($percentage, 2),
            ];
        });

        return $pieData->sortByDesc('net_revenue')->values();
    }

    public function getClientStats(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array
    {
        $totalRevenue = 0;
        $totalConsultantCosts = 0;

        // Get filtered active clients
        $clients = $this->getFilteredClients($clientIds)->get();
        $totalClients = $clients->count();

        foreach ($clients as $client) {
            $clientId = $client->{'co_cliente'};

            $totalRevenue += $this->calculateClientNetRevenue($clientId, $dateFrom, $dateTo);
            $totalConsultantCosts += $this->calculateConsultantCosts($clientId, $dateFrom, $dateTo);
        }

        $totalProfit = $totalRevenue - $totalConsultantCosts;

        return [
            'total_clients' => $totalClients,
            'total_net_revenue' => round($totalRevenue, 2),
            'total_consultant_costs' => round($totalConsultantCosts, 2),
            'total_profit' => round($totalProfit, 2),
            'avg_revenue_per_client' => $totalClients > 0 ? round($totalRevenue / $totalClients, 2) : 0,
            'avg_cost_per_client' => $totalClients > 0 ? round($totalConsultantCosts / $totalClients, 2) : 0,
        ];
    }

    private function getFilteredClients(array $clientIds = []): Builder
    {
        $query = CaoClient::whereNotNull('no_razao')
            ->where('no_razao', '!=', '')
            ->where('tp_cliente', '=', 'A')
            ->select(
                'co_cliente',
                'no_razao',
                'no_fantasia'
            );

        if (! empty($clientIds)) {
            $query->whereIn('co_cliente', $clientIds);
        }

        return $query->orderBy('no_razao');
    }

    private function calculateClientNetRevenue(int $clientId, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): float
    {
        $query = CaoInvoice::where('co_cliente', $clientId);

        if ($dateFrom && $dateTo) {
            $query->whereBetween('data_emissao', [$dateFrom, $dateTo]);
        }

        $invoices = $query->select('valor', 'total_imp_inc')->get();

        $netRevenue = 0;

        foreach ($invoices as $invoice) {
            $tax = ($invoice->{'valor'} * $invoice->{'total_imp_inc'}) / 100;
            $netRevenue += ($invoice->{'valor'} - $tax);
        }

        return $netRevenue;
    }

    private function calculateConsultantCosts(int $clientId, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): float
    {
        $query = CaoInvoice::join('cao_os as os', 'cao_fatura.co_os', '=', 'os.co_os')
            ->join('cao_salario as salary', 'os.co_usuario', '=', 'salary.co_usuario')
            ->where('cao_fatura.co_cliente', $clientId);

        if ($dateFrom && $dateTo) {
            $query->whereBetween('cao_fatura.data_emissao', [$dateFrom, $dateTo]);
        }

        $consultants = $query->select('os.co_usuario', 'salary.brut_salario')
            ->distinct()
            ->get();

        $totalCosts = 0;

        foreach ($consultants as $consultant) {
            $totalCosts += $consultant->{'brut_salario'} ?: 0;
        }

        return $totalCosts;
    }
}
