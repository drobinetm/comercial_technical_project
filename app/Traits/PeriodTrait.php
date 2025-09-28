<?php

namespace App\Traits;

use Carbon\Carbon;

trait PeriodTrait
{
    private function formatMonthPeriod(Carbon $monthStart, Carbon $monthEnd, Carbon $dateFrom, Carbon $dateTo): string
    {
        $monthName = $monthStart->locale('pt_BR')->isoFormat('MMMM YYYY');

        // If it's a complete month and spans the entire month, just return the month name
        if ($monthStart->format('d') === '01' &&
            $monthEnd->equalTo($monthEnd->copy()->endOfMonth()) &&
            $monthStart->gte($dateFrom) &&
            $monthEnd->lte($dateTo)) {
            return $monthName;
        }

        // Otherwise, show the date range
        $rangeText = '';

        // If we start later than the 1st of the month or later than our date range start
        if ($monthStart->format('d') !== '01' || $monthStart->gt($dateFrom)) {
            $rangeText .= 'Desde '.$monthStart->format('d/m/Y');
        }

        // If we end before the last day of the month or before our date range end
        if (! $monthEnd->equalTo($monthEnd->copy()->endOfMonth()) || $monthEnd->lt($dateTo)) {
            if ($rangeText) {
                $rangeText .= ' ';
            }

            $rangeText .= 'Até '.$monthEnd->format('d/m/Y');
        }

        return $rangeText ? $monthName.' ('.$rangeText.')' : $monthName;
    }
}
