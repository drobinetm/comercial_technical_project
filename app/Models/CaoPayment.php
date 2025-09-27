<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoPayment
 *
 * @property int $co_pagamento
 * @property string $co_usuario
 * @property string $tp_pagamento
 * @property Carbon $dt_pagamento
 * @property float $vl_pagamento
 * @property Carbon $dt_referencia_pagamento
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPayment whereCoPagamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPayment whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPayment whereDtPagamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPayment whereDtReferenciaPagamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPayment whereTpPagamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPayment whereVlPagamento($value)
 *
 * @mixin \Eloquent
 */
class CaoPayment extends Model
{
    protected $table = 'cao_pagamento';

    protected $primaryKey = 'co_pagamento';

    public $timestamps = false;

    protected $casts = [
        'dt_pagamento' => 'datetime',
        'vl_pagamento' => 'float',
        'dt_referencia_pagamento' => 'datetime',
    ];

    protected $fillable = [
        'co_usuario',
        'tp_pagamento',
        'dt_pagamento',
        'vl_pagamento',
        'dt_referencia_pagamento',
    ];
}
