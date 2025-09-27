<?php

namespace App\Repositories;

use App\Classes\Consultant\ConsultantCalculation;
use App\Contracts\IConsultantRepositoryInterface;
use App\Models\CaoUser;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ConsultantRepository implements IConsultantRepositoryInterface
{
    protected ConsultantCalculation $consultantCalculation;

    public function __construct(ConsultantCalculation $consultantCalculation)
    {
        $this->consultantCalculation = $consultantCalculation;
    }

    public function listActiveConsultants(): Collection
    {
        return CaoUser::join('permissao_sistema as ps', 'cao_usuario.co_usuario', '=', 'ps.co_usuario')
            ->where('ps.co_sistema', 1)
            ->where('ps.in_ativo', 'S')
            ->whereIn('ps.co_tipo_usuario', [0, 1, 2])
            ->select(
                'cao_usuario.co_usuario',
                'cao_usuario.no_usuario',
                'cao_usuario.no_email',
                'ps.co_tipo_usuario'
            )
            ->orderBy('cao_usuario.no_usuario')
            ->get();
    }

    public function getConsultantReport(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection
    {
        $consultantsQuery = $this->getFilteredConsultants($consultantIds);
        $consultants = $consultantsQuery->get();

        $report = collect();

        foreach ($consultants as $consultant) {
            $metrics = $this->consultantCalculation->metrics(
                $consultant->co_usuario,
                $dateFrom,
                $dateTo
            );

            $report->push([
                'co_usuario' => $consultant->co_usuario,
                'no_usuario' => $consultant->no_usuario,
                'net_revenue' => $metrics['net_revenue'],
                'fixed_cost' => $metrics['fixed_cost'],
                'commission' => $metrics['commission'],
                'profit' => $metrics['profit'],
            ]);
        }

        return $report->sortByDesc('net_revenue');
    }

    public function getConsultantChart(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection
    {
        $consultantsQuery = $this->getFilteredConsultants($consultantIds);
        $consultants = $consultantsQuery->get();

        $chartData = collect();
        $totalFixedCost = 0;
        $consultantCount = $consultants->count();

        foreach ($consultants as $consultant) {
            $netRevenue = $this->consultantCalculation->getNetRevenue($consultant->co_usuario, $dateFrom, $dateTo);
            $fixedCost = $this->consultantCalculation->getFixedCost($consultant->co_usuario, $dateFrom, $dateTo);
            $totalFixedCost += $fixedCost;

            $chartData->push([
                'co_usuario' => $consultant->co_usuario,
                'no_usuario' => $consultant->no_usuario,
                'net_revenue' => $netRevenue,
                'fixed_cost' => $fixedCost,
            ]);
        }

        // Calculate average fixed cost
        $averageFixedCost = $consultantCount > 0 ? round($totalFixedCost / $consultantCount, 2) : 0;

        // Calculate maximum value for chart axes
        $maxRevenue = $chartData->max('net_revenue');
        $maxValue = max($maxRevenue, $averageFixedCost) * 1.1; // 10% more for better visualization

        return collect([
            'data' => $chartData->sortByDesc('net_revenue')->values(),
            'average_fixed_cost' => $averageFixedCost,
            'max_axis_value' => round($maxValue, 0),
        ]);
    }

    public function getConsultantPieChart(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection
    {
        // Get filtered active consultants
        $consultantsQuery = $this->getFilteredConsultants($consultantIds);
        $consultants = $consultantsQuery->get();

        $pieData = collect();
        $totalRevenue = 0;

        // Calculate net revenue for each consultant using calculation service
        foreach ($consultants as $consultant) {
            $netRevenue = $this->consultantCalculation->getNetRevenue($consultant->co_usuario, $dateFrom, $dateTo);

            $pieData->push([
                'co_usuario' => $consultant->co_usuario,
                'no_usuario' => $consultant->no_usuario,
                'net_revenue' => $netRevenue,
            ]);

            $totalRevenue += $netRevenue;
        }

        // Calculate percentages
        $pieData = $pieData->map(function ($item) use ($totalRevenue) {
            $percentage = $totalRevenue > 0 ? ($item['net_revenue'] / $totalRevenue) * 100 : 0;

            return [
                'co_usuario' => $item['co_usuario'],
                'no_usuario' => $item['no_usuario'],
                'net_revenue' => round($item['net_revenue'], 2),
                'percentage' => round($percentage, 2),
            ];
        });

        return $pieData->sortByDesc('net_revenue')->values();
    }

    public function getConsultantStats(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array
    {
        $consultants = $this->getFilteredConsultants($consultantIds)->get();
        $totalConsultants = $consultants->count();

        $totalRevenue = 0;
        $totalFixedCost = 0;
        $totalCommission = 0;

        foreach ($consultants as $consultant) {
            $totalRevenue += $this->consultantCalculation->getNetRevenue($consultant->co_usuario, $dateFrom, $dateTo);
            $totalFixedCost += $this->consultantCalculation->getFixedCost($consultant->co_usuario, $dateFrom, $dateTo);
            $totalCommission += $this->consultantCalculation->getCommission($consultant->co_usuario, $dateFrom, $dateTo);
        }

        $totalProfit = $totalRevenue - ($totalFixedCost + $totalCommission);

        return [
            'total_consultants' => $totalConsultants,
            'total_net_revenue' => round($totalRevenue, 2),
            'total_fixed_cost' => round($totalFixedCost, 2),
            'total_commission' => round($totalCommission, 2),
            'total_profit' => round($totalProfit, 2),
            'avg_revenue_per_consultant' => $totalConsultants > 0 ? round($totalRevenue / $totalConsultants, 2) : 0,
            'avg_fixed_cost_per_consultant' => $totalConsultants > 0 ? round($totalFixedCost / $totalConsultants, 2) : 0,
        ];
    }

    private function getFilteredConsultants(array $consultantIds = [])
    {
        $query = CaoUser::join('permissao_sistema as ps', 'cao_usuario.co_usuario', '=', 'ps.co_usuario')
            ->where('ps.co_sistema', 1)
            ->where('ps.in_ativo', 'S')
            ->whereIn('ps.co_tipo_usuario', [0, 1, 2])
            ->select(
                'cao_usuario.co_usuario',
                'cao_usuario.no_usuario',
                'ps.co_tipo_usuario'
            );

        if (! empty($consultantIds)) {
            $query->whereIn('cao_usuario.co_usuario', $consultantIds);
        }

        return $query->orderBy('cao_usuario.no_usuario');
    }
}
