<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoServiceOrderMovement
 *
 * @property int $co_movimento_os
 * @property int $nu_os
 * @property int $co_sistema
 * @property int|null $co_tipo_movimento
 * @property int|null $nu_valor
 * @property string|null $ds_valor
 * @property string|null $usuario_obs
 * @property Carbon|null $dt_ini
 * @property Carbon|null $dt_fim
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMovement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMovement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMovement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMovement whereCoMovimentoOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMovement whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMovement whereCoTipoMovimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMovement whereDsValor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMovement whereDtFim($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMovement whereDtIni($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMovement whereNuOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMovement whereNuValor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMovement whereUsuarioObs($value)
 *
 * @mixin \Eloquent
 */
class CaoServiceOrderMovement extends Model
{
    protected $table = 'cao_movimento_os';

    protected $primaryKey = 'co_movimento_os';

    public $timestamps = false;

    protected $casts = [
        'nu_os' => 'int',
        'co_sistema' => 'int',
        'co_tipo_movimento' => 'int',
        'nu_valor' => 'int',
        'dt_ini' => 'datetime',
        'dt_fim' => 'datetime',
    ];

    protected $fillable = [
        'nu_os',
        'co_sistema',
        'co_tipo_movimento',
        'nu_valor',
        'ds_valor',
        'usuario_obs',
        'dt_ini',
        'dt_fim',
    ];
}
