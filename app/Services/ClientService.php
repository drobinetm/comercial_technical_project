<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ClientService
{
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

    public function getClientReport(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection
    {
        $report = $this->clientRepository->getClientReport($clientIds, $dateFrom, $dateTo);

        return $report->map(function ($client) {
            return [
                'id' => $client['co_cliente'],
                'name' => $client['no_cliente'],
                'net_revenue' => $client['net_revenue'],
                'consultant_costs' => $client['consultant_costs'],
                'profit' => $client['profit'],
                'profit_margin' => $client['net_revenue'] > 0
                    ? round(($client['profit'] / $client['net_revenue']) * 100, 2)
                    : 0,
                'roi' => $client['consultant_costs'] > 0
                    ? round($client['net_revenue'] / $client['consultant_costs'], 2)
                    : 0,
            ];
        });
    }

    public function getClientReportByMonth(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection
    {
        if (! $dateFrom || ! $dateTo) {
            return collect([]);
        }

        $result = collect([]);
        $current = $dateFrom->copy()->startOfMonth();
        $endDate = $dateTo->copy()->endOfMonth();

        while ($current->lte($endDate)) {
            $monthStart = $current->copy();
            $monthEnd = $current->copy()->endOfMonth();

            if ($monthStart->lt($dateFrom)) {
                $monthStart = $dateFrom->copy();
            }
            if ($monthEnd->gt($dateTo)) {
                $monthEnd = $dateTo->copy();
            }

            $monthData = $this->clientRepository->getClientReport($clientIds, $monthStart, $monthEnd);

            foreach ($monthData as $client) {
                $result->push([
                    'id' => $client['co_cliente'],
                    'name' => $client['no_cliente'],
                    'period' => $this->formatMonthPeriod($monthStart, $monthEnd, $dateFrom, $dateTo),
                    'period_start' => $monthStart->format('Y-m-d'),
                    'period_end' => $monthEnd->format('Y-m-d'),
                    'net_revenue' => $client['net_revenue'],
                    'consultant_costs' => $client['consultant_costs'],
                    'profit' => $client['profit'],
                    'profit_margin' => $client['net_revenue'] > 0
                        ? round(($client['profit'] / $client['net_revenue']) * 100, 2)
                        : 0,
                    'roi' => $client['consultant_costs'] > 0
                        ? round($client['net_revenue'] / $client['consultant_costs'], 2)
                        : 0,
                ]);
            }

            $current->addMonth();
        }

        return $result;
    }

    private function formatMonthPeriod(Carbon $monthStart, Carbon $monthEnd, Carbon $dateFrom, Carbon $dateTo): string
    {
        $monthName = $monthStart->locale('pt_BR')->isoFormat('MMMM YYYY');

        // If it's a complete month and spans the entire month, just return the month name
        if ($monthStart->format('d') === '01' &&
            $monthEnd->equalTo($monthEnd->copy()->endOfMonth()) &&
            $monthStart->gte($dateFrom) &&
            $monthEnd->lte($dateTo)) {
            return $monthName;
        }

        // Otherwise, show the date range
        $rangeText = '';

        // If we start later than the 1st of the month or later than our date range start
        if ($monthStart->format('d') !== '01' || $monthStart->gt($dateFrom)) {
            $rangeText .= 'Desde '.$monthStart->format('d/m/Y');
        }

        // If we end before the last day of the month or before our date range end
        if (! $monthEnd->equalTo($monthEnd->copy()->endOfMonth()) || $monthEnd->lt($dateTo)) {
            if ($rangeText) {
                $rangeText .= ' ';
            }
            $rangeText .= 'Até '.$monthEnd->format('d/m/Y');
        }

        return $rangeText ? $monthName.' ('.$rangeText.')' : $monthName;
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

        return array_merge($stats, [
            'total_profit' => round($totalProfit, 2),
            'profit_margin_percentage' => $profitMargin,
            'average_revenue_per_client' => $stats['total_clients'] > 0
                ? round($stats['total_net_revenue'] / $stats['total_clients'], 2)
                : 0,
            'roi_ratio' => $stats['total_consultant_costs'] > 0
                ? round($stats['total_net_revenue'] / $stats['total_consultant_costs'], 2)
                : 0,
            'period' => [
                'from' => $dateFrom?->format('Y-m-d'),
                'to' => $dateTo?->format('Y-m-d'),
            ],
        ]);
    }

    public function getDashboardSummary(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array
    {
        $stats = $this->getClientStats($clientIds, $dateFrom, $dateTo);
        $report = $this->getClientReport($clientIds, $dateFrom, $dateTo);

        return [
            'summary' => [
                'total_clients' => $stats['total_clients'],
                'total_revenue' => $stats['total_net_revenue'],
                'total_profit' => $stats['total_profit'],
                'average_roi' => $report->avg('roi'),
                'top_client' => $report->sortByDesc('net_revenue')->first(),
                'period_label' => $this->getPeriodLabel($dateFrom, $dateTo),
            ],
            'trends' => [
                'revenue_trend' => 'stable', // This could be calculated from historical data
                'profit_trend' => 'increasing',
                'client_acquisition_trend' => 'stable',
            ],
        ];
    }

    private function getPeriodLabel(?Carbon $dateFrom = null, ?Carbon $dateTo = null): string
    {
        if (! $dateFrom && ! $dateTo) {
            return 'All Time';
        }

        if (! $dateTo) {
            return 'From '.$dateFrom->format('M Y');
        }

        if (! $dateFrom) {
            return 'Until '.$dateTo->format('M Y');
        }

        if ($dateFrom->year === $dateTo->year) {
            if ($dateFrom->month === $dateTo->month) {
                return $dateFrom->format('M Y');
            }

            return $dateFrom->format('M').' - '.$dateTo->format('M Y');
        }

        return $dateFrom->format('M Y').' - '.$dateTo->format('M Y');
    }

    public function validateClientIds(array $clientIds): array
    {
        if (empty($clientIds)) {
            return [];
        }

        $activeClients = $this->getActiveClients();
        $validIds = $activeClients->pluck('id')->toArray();

        return array_intersect($clientIds, $validIds);
    }

    public function getClientPerformanceComparison(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array
    {
        $report = $this->getClientReport($clientIds, $dateFrom, $dateTo);

        if ($report->isEmpty()) {
            return [
                'clients' => [],
                'benchmarks' => [
                    'avg_revenue' => 0,
                    'avg_roi' => 0,
                    'avg_profit_margin' => 0,
                ],
            ];
        }

        $avgRevenue = $report->avg('net_revenue');
        $avgRoi = $report->avg('roi');
        $avgProfitMargin = $report->avg('profit_margin');

        $clients = $report->map(function ($client) use ($report, $avgRevenue, $avgRoi, $avgProfitMargin) {
            return array_merge($client, [
                'performance_vs_avg' => [
                    'revenue' => $avgRevenue > 0 ? round((($client['net_revenue'] - $avgRevenue) / $avgRevenue) * 100, 2) : 0,
                    'roi' => $avgRoi > 0 ? round((($client['roi'] - $avgRoi) / $avgRoi) * 100, 2) : 0,
                    'profit_margin' => $avgProfitMargin > 0 ? round((($client['profit_margin'] - $avgProfitMargin) / $avgProfitMargin) * 100, 2) : 0,
                ],
                'rank' => [
                    'revenue' => $report->sortByDesc('net_revenue')->keys()->search($client['id']) + 1,
                    'roi' => $report->sortByDesc('roi')->keys()->search($client['id']) + 1,
                    'profit_margin' => $report->sortByDesc('profit_margin')->keys()->search($client['id']) + 1,
                ],
            ]);
        });

        return [
            'clients' => $clients,
            'benchmarks' => [
                'avg_revenue' => round($avgRevenue, 2),
                'avg_roi' => round($avgRoi, 2),
                'avg_profit_margin' => round($avgProfitMargin, 2),
            ],
        ];
    }
}
