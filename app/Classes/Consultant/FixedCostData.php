<?php

namespace App\Classes\Consultant;

use App\Contracts\ICalculationStrategyInterface;
use App\Models\CaoSalary;
use Carbon\Carbon;

class FixedCostData implements ICalculationStrategyInterface
{
    public function calculate(string $consultantId, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): float
    {
        $salary = CaoSalary::where('co_usuario', $consultantId)->first();

        return $salary ? round($salary->brut_salario, 2) : 0;
    }
}
