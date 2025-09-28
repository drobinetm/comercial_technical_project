<?php

namespace App\Contracts;

use Carbon\Carbon;

interface ICalculationDataInterface
{
    public function calculate(string $consultantId, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): float;
}
