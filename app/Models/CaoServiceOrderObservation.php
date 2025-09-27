<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoServiceOrderObservation
 *
 * @property int $co_obs
 * @property int|null $co_os
 * @property string|null $co_usuario
 * @property string|null $descricao
 * @property Carbon|null $dt_obs
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderObservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderObservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderObservation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderObservation whereCoObs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderObservation whereCoOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderObservation whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderObservation whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderObservation whereDtObs($value)
 *
 * @mixin \Eloquent
 */
class CaoServiceOrderObservation extends Model
{
    protected $table = 'cao_os_obs';

    protected $primaryKey = 'co_obs';

    public $timestamps = false;

    protected $casts = [
        'co_os' => 'int',
        'dt_obs' => 'datetime',
    ];

    protected $fillable = [
        'co_os',
        'co_usuario',
        'descricao',
        'dt_obs',
    ];
}
