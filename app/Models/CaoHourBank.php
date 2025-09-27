<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoHourBank
 *
 * @property int $co_banc_horas
 * @property string $co_usuario
 * @property string $periodo
 * @property int $min_mes
 * @property int $min_ferias
 * @property int $min_pago
 * @property int $min_total
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHourBank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHourBank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHourBank query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHourBank whereCoBancHoras($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHourBank whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHourBank whereMinFerias($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHourBank whereMinMes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHourBank whereMinPago($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHourBank whereMinTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHourBank wherePeriodo($value)
 *
 * @mixin \Eloquent
 */
class CaoHourBank extends Model
{
    protected $table = 'cao_banco_horas';

    protected $primaryKey = 'co_banc_horas';

    public $timestamps = false;

    protected $casts = [
        'min_mes' => 'int',
        'min_ferias' => 'int',
        'min_pago' => 'int',
        'min_total' => 'int',
    ];

    protected $fillable = [
        'co_usuario',
        'periodo',
        'min_mes',
        'min_ferias',
        'min_pago',
        'min_total',
    ];
}
