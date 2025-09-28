<?php

namespace App\Classes\Consultant;

use App\Contracts\ICalculationDataInterface;
use Carbon\Carbon;

class ProfitData implements ICalculationDataInterface
{
    private NetRevenueData $netRevenueData;

    private FixedCostData $fixedCostData;

    private CommissionData $commissionData;

    public function __construct()
    {
        $this->netRevenueData = new NetRevenueData;
        $this->fixedCostData = new FixedCostData;
        $this->commissionData = new CommissionData;
    }

    public function calculate(string $consultantId, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): float
    {
        $netRevenue = $this->netRevenueData->calculate($consultantId, $dateFrom, $dateTo);
        $fixedCost = $this->fixedCostData->calculate($consultantId, $dateFrom, $dateTo);
        $commission = $this->commissionData->calculate($consultantId, $dateFrom, $dateTo);

        $profit = $netRevenue - ($fixedCost + $commission);

        return round($profit, 2);
    }
}
