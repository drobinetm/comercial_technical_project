<?php

namespace App\Contracts;

use Carbon\Carbon;
use Illuminate\Support\Collection;

interface IClientRepositoryInterface
{
   public function listActiveClients(): Collection;
   public function getClientReport(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection;
    public function getClientChart(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection;
    public function getClientPieChart(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): Collection;
    public function getClientStats(array $clientIds = [], ?Carbon $dateFrom = null, ?Carbon $dateTo = null): array;
}
