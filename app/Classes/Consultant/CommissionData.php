<?php

namespace App\Classes\Consultant;

use App\Contracts\ICalculationDataInterface;
use App\Models\CaoInvoice;
use Carbon\Carbon;

class CommissionData implements ICalculationDataInterface
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
            'cao_fatura.total_imp_inc',
            'cao_fatura.comissao_cn'
        )->get();

        $totalCommission = 0;

        foreach ($invoices as $invoice) {
            $netValue = $invoice->valor - (($invoice->valor * $invoice->total_imp_inc) / 100);
            $commission = ($netValue * $invoice->comissao_cn) / 100;
            $totalCommission += $commission;
        }

        return round($totalCommission, 2);
    }
}
