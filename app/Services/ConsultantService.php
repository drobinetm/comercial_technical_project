<?php

namespace App\Services;

use App\Repositories\ConsultantRepository;
use App\Traits\PeriodTrait;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ConsultantService
{
    use PeriodTrait;

    protected ConsultantRepository $consultantRepository;

    public function __construct(ConsultantRepository $consultantRepository)
    {
        $this->consultantRepository = $consultantRepository;
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

    public function getConsultantReportByMonth(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection
    {
        if (! $dateFrom || ! $dateTo) {
            return collect();
        }

        $result = collect();
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

            // Get the period
            $period = $this->formatMonthPeriod($monthStart, $monthEnd, $dateFrom, $dateTo);

            // Get data for this month
            $monthData = $this->consultantRepository->getConsultantReport($consultantIds, $monthStart, $monthEnd);

            foreach ($monthData as $consultant) {
                $profitMargin = $consultant['net_revenue'] > 0
                    ? round(($consultant['profit'] / $consultant['net_revenue']) * 100, 2)
                    : 0;

                $performanceRatio = $consultant['fixed_cost'] > 0
                    ? round($consultant['net_revenue'] / $consultant['fixed_cost'], 2)
                    : 0;

                $result->push([
                    'id' => $consultant['co_usuario'],
                    'name' => $consultant['no_usuario'],
                    'period' => $period,
                    'period_start' => $monthStart->format('Y-m-d'),
                    'period_end' => $monthEnd->format('Y-m-d'),
                    'receita' => $consultant['net_revenue'],
                    'custo' => $consultant['fixed_cost'],
                    'comissao' => $consultant['commission'],
                    'lucro' => $consultant['profit'],
                    'profit_margin' => $profitMargin,
                    'performance_ratio' => $performanceRatio,
                ]);
            }

            $current->addMonth();
        }

        return $result;
    }

    public function getConsultantChart(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array
    {
        $chartData = $this->consultantRepository->getConsultantChart($consultantIds, $dateFrom, $dateTo);

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
                        'borderWidth' => 2,
                        'data' => $data->pluck('net_revenue')->toArray(),
                        'backgroundColor' => $data->pluck('color')->toArray(),
                        'borderColor' => $data->pluck('color')->map(function ($color) {
                            return str_replace('0.8', '1', $color);
                        })->toArray(),
                    ],
                ],
            ],
            'total_revenue' => $data->sum('net_revenue'),
        ];
    }

    public function getConsultantStats(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array
    {
        $stats = $this->consultantRepository->getConsultantStats($consultantIds, $dateFrom, $dateTo);

        $averageProfit = $stats['total_net_revenue'] - ($stats['total_fixed_cost'] + $stats['total_commission']);

        $profitMargin = $stats['total_net_revenue'] > 0
            ? round(($averageProfit / $stats['total_net_revenue']) * 100, 2)
            : 0;

        $efficiencyRatio = $stats['total_fixed_cost'] > 0
            ? round($stats['total_net_revenue'] / $stats['total_fixed_cost'], 2)
            : 0;

        return array_merge($stats, [
            'average_profit' => round($averageProfit, 2),
            'profit_margin_percentage' => $profitMargin,
            'efficiency_ratio' => $efficiencyRatio,
            'period' => [
                'from' => $dateFrom?->format('Y-m-d'),
                'to' => $dateTo?->format('Y-m-d'),
            ],
        ]);
    }
}
