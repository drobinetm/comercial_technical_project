<?php

namespace App\Contracts;

use Carbon\Carbon;

interface ICalculationStrategyInterface
{
    public function calculate(string $consultantId, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): float;
}
