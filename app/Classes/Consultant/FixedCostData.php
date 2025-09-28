<?php

namespace App\Classes\Consultant;

use App\Contracts\ICalculationDataInterface;
use App\Models\CaoSalary;
use Carbon\Carbon;

class FixedCostData implements ICalculationDataInterface
{
    public function calculate(string $consultantId, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): float
    {
        $salary = CaoSalary::where('co_usuario', $consultantId)->first();

        return $salary ? round($salary->brut_salario, 2) : 0;
    }
}
