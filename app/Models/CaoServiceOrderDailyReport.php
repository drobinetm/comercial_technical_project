<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoServiceOrderDailyReport
 *
 * @property int $co_daily
 * @property int|null $co_os
 * @property int|null $co_fase
 * @property string|null $co_usuario
 * @property string|null $ds_assunto
 * @property Carbon|null $tempo_gasto
 * @property Carbon|null $data
 * @property int|null $co_status_atual
 * @property int|null $co_chamado
 * @property int|null $co_atividade
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDailyReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDailyReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDailyReport query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDailyReport whereCoAtividade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDailyReport whereCoChamado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDailyReport whereCoDaily($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDailyReport whereCoFase($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDailyReport whereCoOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDailyReport whereCoStatusAtual($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDailyReport whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDailyReport whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDailyReport whereDsAssunto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDailyReport whereTempoGasto($value)
 *
 * @mixin \Eloquent
 */
class CaoServiceOrderDailyReport extends Model
{
    protected $table = 'cao_os_daily_report';

    protected $primaryKey = 'co_daily';

    public $timestamps = false;

    protected $casts = [
        'co_os' => 'int',
        'co_fase' => 'int',
        'tempo_gasto' => 'datetime',
        'data' => 'datetime',
        'co_status_atual' => 'int',
        'co_chamado' => 'int',
        'co_atividade' => 'int',
    ];

    protected $fillable = [
        'co_os',
        'co_fase',
        'co_usuario',
        'ds_assunto',
        'tempo_gasto',
        'data',
        'co_status_atual',
        'co_chamado',
        'co_atividade',
    ];
}
