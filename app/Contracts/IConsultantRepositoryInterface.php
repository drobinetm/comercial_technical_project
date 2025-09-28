<?php

namespace App\Contracts;

use Carbon\Carbon;
use Illuminate\Support\Collection;

interface IConsultantRepositoryInterface
{
    public function listActiveConsultants(): Collection;

    public function getConsultantReport(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection;

    public function getConsultantChart(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection;

    public function getConsultantPieChart(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection;

    public function getConsultantStats(array $consultantIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array;
}
