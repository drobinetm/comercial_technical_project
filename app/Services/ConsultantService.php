<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use App\Repositories\ConsultantRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ConsultantService
{
    protected ConsultantRepository $consultantRepository;

    protected ClientRepository $clientRepository;

    public function __construct(ConsultantRepository $consultantRepository, ClientRepository $clientRepository)
    {
        $this->consultantRepository = $consultantRepository;
        $this->clientRepository = $clientRepository;
    }

    public function getActiveConsultants(): Collection
    {
        $consultants = $this->consultantRepository->listActiveConsultants();

        return $consultants->map(function ($consultant) {
            return [
                'id' => $consultant->co_usuario,
                'name' => $consultant->no_usuario,
                'email' => $consultant->no_email,
                'type' => $consultant->co_tipo_usuario,
            ];
        });
    }

    public function getConsultantReport(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection
    {
        $report = $this->consultantRepository->getConsultantReport($consultantIds, $dateFrom, $dateTo);

        // Transform data for frontend consumption
        return $report->map(function ($consultant) {
            return [
                'id' => $consultant['co_usuario'],
                'name' => $consultant['no_usuario'],
                'net_revenue' => $consultant['net_revenue'],
                'fixed_cost' => $consultant['fixed_cost'],
                'commission' => $consultant['commission'],
                'profit' => $consultant['profit'],
                'profit_margin' => $consultant['net_revenue'] > 0
                    ? round(($consultant['profit'] / $consultant['net_revenue']) * 100, 2)
                    : 0,
                'performance_ratio' => $consultant['fixed_cost'] > 0
                    ? round($consultant['net_revenue'] / $consultant['fixed_cost'], 2)
                    : 0,
            ];
        });
    }

    public function getConsultantReportByMonth(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection
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

            // Adjust for the actual date range
            if ($monthStart->lt($dateFrom)) {
                $monthStart = $dateFrom->copy();
            }
            if ($monthEnd->gt($dateTo)) {
                $monthEnd = $dateTo->copy();
            }

            // Get data for this month
            $monthData = $this->consultantRepository->getConsultantReport($consultantIds, $monthStart, $monthEnd);

            foreach ($monthData as $consultant) {
                $result->push([
                    'id' => $consultant['co_usuario'],
                    'name' => $consultant['no_usuario'],
                    'period' => $this->formatMonthPeriod($monthStart, $monthEnd, $dateFrom, $dateTo),
                    'period_start' => $monthStart->format('Y-m-d'),
                    'period_end' => $monthEnd->format('Y-m-d'),
                    // Frontend expects Portuguese field names
                    'receita' => $consultant['net_revenue'],
                    'custo' => $consultant['fixed_cost'],
                    'comissao' => $consultant['commission'],
                    'lucro' => $consultant['profit'],
                    'profit_margin' => $consultant['net_revenue'] > 0
                        ? round(($consultant['profit'] / $consultant['net_revenue']) * 100, 2)
                        : 0,
                    'performance_ratio' => $consultant['fixed_cost'] > 0
                        ? round($consultant['net_revenue'] / $consultant['fixed_cost'], 2)
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

    public function getConsultantChart(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array
    {
        $chartData = $this->consultantRepository->getConsultantChart($consultantIds, $dateFrom, $dateTo);

        // Transform for Chart.js consumption
        $data = $chartData['data']->map(function ($consultant) {
            return [
                'id' => $consultant['co_usuario'],
                'name' => $consultant['no_usuario'],
                'net_revenue' => $consultant['net_revenue'],
                'fixed_cost' => $consultant['fixed_cost'],
            ];
        });

        return [
            'consultants' => $data,
            'average_fixed_cost' => $chartData['average_fixed_cost'],
            'max_axis_value' => $chartData['max_axis_value'],
            'chart_config' => [
                'labels' => $data->pluck('name')->toArray(),
                'datasets' => [
                    [
                        'label' => 'Net Revenue',
                        'data' => $data->pluck('net_revenue')->toArray(),
                        'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                        'borderColor' => 'rgba(54, 162, 235, 1)',
                        'borderWidth' => 1,
                    ],
                    [
                        'label' => 'Fixed Cost',
                        'data' => $data->pluck('fixed_cost')->toArray(),
                        'backgroundColor' => 'rgba(255, 99, 132, 0.5)',
                        'borderColor' => 'rgba(255, 99, 132, 1)',
                        'borderWidth' => 1,
                    ],
                ],
            ],
            'average_line' => [
                'value' => $chartData['average_fixed_cost'],
                'label' => 'Average Fixed Cost',
            ],
        ];
    }

    public function getConsultantPieChart(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array
    {
        $pieData = $this->consultantRepository->getConsultantPieChart($consultantIds, $dateFrom, $dateTo);

        // Generate colors for the pie chart
        $colors = [
            'rgba(255, 99, 132, 0.8)',
            'rgba(54, 162, 235, 0.8)',
            'rgba(255, 205, 86, 0.8)',
            'rgba(75, 192, 192, 0.8)',
            'rgba(153, 102, 255, 0.8)',
            'rgba(255, 159, 64, 0.8)',
            'rgba(199, 199, 199, 0.8)',
            'rgba(83, 102, 255, 0.8)',
        ];

        $data = $pieData->map(function ($consultant, $index) use ($colors) {
            return [
                'id' => $consultant['co_usuario'],
                'name' => $consultant['no_usuario'],
                'net_revenue' => $consultant['net_revenue'],
                'percentage' => $consultant['percentage'],
                'color' => $colors[$index % count($colors)],
            ];
        });

        return [
            'consultants' => $data,
            'chart_config' => [
                'labels' => $data->pluck('name')->toArray(),
                'datasets' => [
                    [
                        'data' => $data->pluck('net_revenue')->toArray(),
                        'backgroundColor' => $data->pluck('color')->toArray(),
                        'borderColor' => $data->pluck('color')->map(function ($color) {
                            return str_replace('0.8', '1', $color);
                        })->toArray(),
                        'borderWidth' => 2,
                    ],
                ],
            ],
            'total_revenue' => $data->sum('net_revenue'),
        ];
    }

    public function getConsultantStats(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array
    {
        $stats = $this->consultantRepository->getConsultantStats($consultantIds, $dateFrom, $dateTo);

        // Add additional business metrics
        $averageProfit = $stats['total_net_revenue'] - ($stats['total_fixed_cost'] + $stats['total_commission']);
        $profitMargin = $stats['total_net_revenue'] > 0
            ? round(($averageProfit / $stats['total_net_revenue']) * 100, 2)
            : 0;

        return array_merge($stats, [
            'average_profit' => round($averageProfit, 2),
            'profit_margin_percentage' => $profitMargin,
            'efficiency_ratio' => $stats['total_fixed_cost'] > 0
                ? round($stats['total_net_revenue'] / $stats['total_fixed_cost'], 2)
                : 0,
            'period' => [
                'from' => $dateFrom?->format('Y-m-d'),
                'to' => $dateTo?->format('Y-m-d'),
            ],
        ]);
    }

    public function getDashboardSummary(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array
    {
        $stats = $this->getConsultantStats($consultantIds, $dateFrom, $dateTo);
        $report = $this->getConsultantReport($consultantIds, $dateFrom, $dateTo);

        return [
            'summary' => [
                'total_consultants' => $stats['total_consultants'],
                'total_revenue' => $stats['total_net_revenue'],
                'total_profit' => $stats['average_profit'],
                'average_performance' => $report->avg('performance_ratio'),
                'top_performer' => $report->sortByDesc('net_revenue')->first(),
                'period_label' => $this->getPeriodLabel($dateFrom, $dateTo),
            ],
            'trends' => [
                'revenue_trend' => 'stable', // This could be calculated from historical data
                'profit_trend' => 'increasing',
                'efficiency_trend' => 'stable',
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

    public function validateConsultantIds(array $consultantIds): array
    {
        if (empty($consultantIds)) {
            return [];
        }

        $activeConsultants = $this->getActiveConsultants();
        $validIds = $activeConsultants->pluck('co_usuario')->toArray();

        return array_intersect($consultantIds, $validIds);
    }
}
