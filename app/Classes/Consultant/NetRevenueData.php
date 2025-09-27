<?php

namespace App\Classes\Consultant;

use App\Contracts\CalculationStrategyInterface;
use App\Models\CaoInvoice;
use Carbon\Carbon;

class NetRevenueData implements CalculationStrategyInterface
{
    public function calculate(string $consultantId, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): float
    {
        $query = CaoInvoice::join('cao_os as os', 'cao_fatura.co_os', '=', 'os.co_os')
            ->where('os.co_usuario', $consultantId);

        if ($dateFrom && $dateTo) {
            $query->whereBetween('cao_fatura.data_emissao', [$dateFrom, $dateTo]);
        }

        $invoices = $query->select(
            'cao_fatura.valor',
            'cao_fatura.total_imp_inc'
        )->get();

        $netRevenue = 0;

        foreach ($invoices as $invoice) {
            $taxAmount = ($invoice->valor * $invoice->total_imp_inc) / 100;
            $netRevenue += ($invoice->valor - $taxAmount);
        }

        return round($netRevenue, 2);
    }
}
