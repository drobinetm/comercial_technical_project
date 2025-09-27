<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoClientObservation
 *
 * @property int $co_obs
 * @property string $descricao
 * @property int $co_cliente
 * @property string|null $co_usuario
 * @property Carbon|null $dt_obs
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientObservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientObservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientObservation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientObservation whereCoCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientObservation whereCoObs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientObservation whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientObservation whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientObservation whereDtObs($value)
 *
 * @mixin \Eloquent
 */
class CaoClientObservation extends Model
{
    protected $table = 'cao_obs_cliente';

    protected $primaryKey = 'co_obs';

    public $timestamps = false;

    protected $casts = [
        'co_cliente' => 'int',
        'dt_obs' => 'datetime',
    ];

    protected $fillable = [
        'descricao',
        'co_cliente',
        'co_usuario',
        'dt_obs',
    ];
}
