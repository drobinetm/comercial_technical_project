<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoInvoicePayment
 *
 * @property int $id_fatura_pag
 * @property int $co_fatura
 * @property Carbon $dt_efetuado
 * @property float $valor_pago
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoicePayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoicePayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoicePayment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoicePayment whereCoFatura($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoicePayment whereDtEfetuado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoicePayment whereIdFaturaPag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoicePayment whereValorPago($value)
 *
 * @mixin \Eloquent
 */
class CaoInvoicePayment extends Model
{
    protected $table = 'cao_fatura_pag';

    protected $primaryKey = 'id_fatura_pag';

    public $timestamps = false;

    protected $casts = [
        'co_fatura' => 'int',
        'dt_efetuado' => 'datetime',
        'valor_pago' => 'float',
    ];

    protected $fillable = [
        'co_fatura',
        'dt_efetuado',
        'valor_pago',
    ];
}
