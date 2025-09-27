<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoCost
 *
 * @property int $co_custo
 * @property int $co_tipo_custo
 * @property string $descricao
 * @property int $co_escritorio
 * @property Carbon|null $dt_compra
 * @property Carbon|null $dt_pagamento
 * @property string|null $co_boleto
 * @property float $valor
 * @property string|null $parcela
 * @property bool|null $pag
 * @property int $co_custo_high
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCost query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCost whereCoBoleto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCost whereCoCusto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCost whereCoCustoHigh($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCost whereCoEscritorio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCost whereCoTipoCusto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCost whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCost whereDtCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCost whereDtPagamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCost wherePag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCost whereParcela($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCost whereValor($value)
 *
 * @mixin \Eloquent
 */
class CaoCost extends Model
{
    protected $table = 'cao_custo';

    protected $primaryKey = 'co_custo';

    public $timestamps = false;

    protected $casts = [
        'co_tipo_custo' => 'int',
        'co_escritorio' => 'int',
        'dt_compra' => 'datetime',
        'dt_pagamento' => 'datetime',
        'valor' => 'float',
        'pag' => 'bool',
        'co_custo_high' => 'int',
    ];

    protected $fillable = [
        'co_tipo_custo',
        'descricao',
        'co_escritorio',
        'dt_compra',
        'dt_pagamento',
        'co_boleto',
        'valor',
        'parcela',
        'pag',
        'co_custo_high',
    ];
}
