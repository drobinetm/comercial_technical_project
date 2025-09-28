<?php

namespace App\Classes\Consultant;

use Carbon\Carbon;

class ConsultantCalculation
{
    private NetRevenueData $netRevenueData;

    private FixedCostData $fixedCostData;

    private CommissionData $commissionData;

    private ProfitData $profitData;

    public function __construct(
        ?NetRevenueData $netRevenueData = null,
        ?FixedCostData $fixedCostData = null,
        ?CommissionData $commissionData = null,
        ?ProfitData $profitData = null
    ) {
        $this->netRevenueData = $netRevenueData ?? new NetRevenueData;
        $this->fixedCostData = $fixedCostData ?? new FixedCostData;
        $this->commissionData = $commissionData ?? new CommissionData;
        $this->profitData = $profitData ?? new ProfitData;
    }

    public function getNetRevenue(string $consultantId, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): float
    {
        return $this->netRevenueData->calculate($consultantId, $dateFrom, $dateTo);
    }

    public function getFixedCost(string $consultantId, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): float
    {
        return $this->fixedCostData->calculate($consultantId, $dateFrom, $dateTo);
    }

    public function getCommission(string $consultantId, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): float
    {
        return $this->commissionData->calculate($consultantId, $dateFrom, $dateTo);
    }

    public function getProfit(string $consultantId, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): float
    {
        return $this->profitData->calculate($consultantId, $dateFrom, $dateTo);
    }

    public function metrics(string $consultantId, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array
    {
        return [
            'net_revenue' => $this->getNetRevenue($consultantId, $dateFrom, $dateTo),
            'fixed_cost' => $this->getFixedCost($consultantId, $dateFrom, $dateTo),
            'commission' => $this->getCommission($consultantId, $dateFrom, $dateTo),
            'profit' => $this->getProfit($consultantId, $dateFrom, $dateTo),
        ];
    }
}
