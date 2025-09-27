<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoInvoice
 *
 * @property int $co_fatura
 * @property int $co_cliente
 * @property int $co_sistema
 * @property int $co_os
 * @property int $num_nf
 * @property float $total
 * @property float $valor
 * @property Carbon $data_emissao
 * @property string $corpo_nf
 * @property float $comissao_cn
 * @property float $total_imp_inc
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoice whereCoCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoice whereCoFatura($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoice whereCoOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoice whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoice whereComissaoCn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoice whereCorpoNf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoice whereDataEmissao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoice whereNumNf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoice whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoice whereTotalImpInc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoInvoice whereValor($value)
 *
 * @mixin \Eloquent
 */
class CaoInvoice extends Model
{
    protected $table = 'cao_fatura';

    protected $primaryKey = 'co_fatura';

    public $timestamps = false;

    protected $casts = [
        'co_cliente' => 'int',
        'co_sistema' => 'int',
        'co_os' => 'int',
        'num_nf' => 'int',
        'total' => 'float',
        'valor' => 'float',
        'data_emissao' => 'datetime',
        'comissao_cn' => 'float',
        'total_imp_inc' => 'float',
    ];

    protected $fillable = [
        'co_cliente',
        'co_sistema',
        'co_os',
        'num_nf',
        'total',
        'valor',
        'data_emissao',
        'corpo_nf',
        'comissao_cn',
        'total_imp_inc',
    ];
}
