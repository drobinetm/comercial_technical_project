<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use App\Traits\PeriodTrait;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ClientService
{
    use PeriodTrait;

    protected ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function getActiveClients(): Collection
    {
        $clients = $this->clientRepository->listActiveClients();

        return $clients->map(function ($client) {
            return [
                'id' => (string) $client->co_cliente,
                'name' => $client->no_fantasia ?: $client->no_razao,
                'email' => $client->ds_email,
                'contact' => $client->no_contato,
            ];
        });
    }

    public function getClientReportByMonth(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection
    {
        if (! $dateFrom || ! $dateTo) {
            return collect();
        }

        $result = collect();
        $endDate = $dateTo->copy()->endOfMonth();
        $current = $dateFrom->copy()->startOfMonth();

        while ($current->lte($endDate)) {
            $monthEnd = $current->copy()->endOfMonth();
            $monthStart = $current->copy();

            if ($monthStart->lt($dateFrom)) {
                $monthStart = $dateFrom->copy();
            }
            if ($monthEnd->gt($dateTo)) {
                $monthEnd = $dateTo->copy();
            }

            // Get the period
            $period = $this->formatMonthPeriod($monthStart, $monthEnd, $dateFrom, $dateTo);

            // Get data for this month
            $monthData = $this->clientRepository->getClientReport($clientIds, $monthStart, $monthEnd);

            foreach ($monthData as $client) {
                $profitMargin = $client['net_revenue'] > 0
                    ? round(($client['profit'] / $client['net_revenue']) * 100, 2)
                    : 0;

                $roi = $client['consultant_costs'] > 0
                    ? round($client['net_revenue'] / $client['consultant_costs'], 2)
                    : 0;

                $result->push([
                    'id' => $client['co_cliente'],
                    'name' => $client['no_cliente'],
                    'period' => $period,
                    'period_start' => $monthStart->format('Y-m-d'),
                    'period_end' => $monthEnd->format('Y-m-d'),
                    'net_revenue' => $client['net_revenue'],
                    'consultant_costs' => $client['consultant_costs'],
                    'profit' => $client['profit'],
                    'profit_margin' => $profitMargin,
                    'roi' => $roi,
                ]);
            }

            $current->addMonth();
        }

        return $result;
    }

    public function getClientChart(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array
    {
        $chartData = $this->clientRepository->getClientChart($clientIds, $dateFrom, $dateTo);

        $data = $chartData['data']->map(function ($client) {
            return [
                'id' => $client['co_cliente'],
                'name' => $client['no_cliente'],
                'net_revenue' => $client['net_revenue'],
                'consultant_costs' => $client['consultant_costs'],
                'profit' => $client['profit'],
            ];
        });

        return [
            'clients' => $data,
            'average_consultant_costs' => $chartData['average_consultant_costs'] ?? 0,
            'max_axis_value' => $chartData['max_axis_value'] ?? 0,
            'chart_config' => [
                'labels' => $data->pluck('name')->toArray(),
                'datasets' => [
                    [
                        'label' => 'Receita Líquida',
                        'data' => $data->pluck('net_revenue')->toArray(),
                        'backgroundColor' => 'rgba(34, 197, 94, 0.6)',
                        'borderColor' => 'rgba(34, 197, 94, 1)',
                        'borderWidth' => 2,
                    ],
                    [
                        'label' => 'Custos de Consultoria',
                        'data' => $data->pluck('consultant_costs')->toArray(),
                        'backgroundColor' => 'rgba(239, 68, 68, 0.6)',
                        'borderColor' => 'rgba(239, 68, 68, 1)',
                        'borderWidth' => 2,
                    ],
                ],
            ],
            'average_line' => [
                'value' => $chartData['average_consultant_costs'] ?? 0,
                'label' => 'Custo Médio de Consultoria',
            ],
        ];
    }

    public function getClientPieChart(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array
    {
        $pieData = $this->clientRepository->getClientPieChart($clientIds, $dateFrom, $dateTo);

        $colors = [
            '#10B981', // Green
            '#3B82F6', // Blue
            '#F59E0B', // Amber
            '#EF4444', // Red
            '#8B5CF6', // Purple
            '#F97316', // Orange
            '#06B6D4', // Cyan
            '#84CC16', // Lime
            '#EC4899', // Pink
            '#6B7280', // Gray
        ];

        $data = $pieData->map(function ($client, $index) use ($colors) {
            return [
                'id' => $client['co_cliente'],
                'name' => $client['no_cliente'],
                'net_revenue' => $client['net_revenue'],
                'percentage' => $client['percentage'],
                'color' => $colors[$index % count($colors)],
            ];
        });

        return [
            'clients' => $data,
            'chart_config' => [
                'labels' => $data->pluck('name')->toArray(),
                'datasets' => [
                    [
                        'data' => $data->pluck('net_revenue')->toArray(),
                        'backgroundColor' => $data->pluck('color')->toArray(),
                        'borderColor' => $data->pluck('color')->map(function ($color) {
                            return $color.'FF'; // Add full opacity
                        })->toArray(),
                        'borderWidth' => 2,
                        'hoverBackgroundColor' => $data->pluck('color')->map(function ($color) {
                            return $color.'CC'; // Slightly transparent on hover
                        })->toArray(),
                    ],
                ],
            ],
            'total_revenue' => $data->sum('net_revenue'),
            'total_clients' => $data->count(),
        ];
    }

    public function getClientStats(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array
    {
        $stats = $this->clientRepository->getClientStats($clientIds, $dateFrom, $dateTo);

        $totalProfit = $stats['total_net_revenue'] - $stats['total_consultant_costs'];

        $profitMargin = $stats['total_net_revenue'] > 0
            ? round(($totalProfit / $stats['total_net_revenue']) * 100, 2)
            : 0;

        $averageRevenueClient = $stats['total_clients'] > 0
        ? round($stats['total_net_revenue'] / $stats['total_clients'], 2)
        : 0;

        $roiRatio = $stats['total_consultant_costs'] > 0
        ? round($stats['total_net_revenue'] / $stats['total_consultant_costs'], 2)
        : 0;

        return array_merge($stats, [
            'total_profit' => round($totalProfit, 2),
            'profit_margin_percentage' => $profitMargin,
            'average_revenue_per_client' => $averageRevenueClient,
            'roi_ratio' => $roiRatio,
            'period' => [
                'from' => $dateFrom?->format('Y-m-d'),
                'to' => $dateTo?->format('Y-m-d'),
            ],
        ]);
    }
}
