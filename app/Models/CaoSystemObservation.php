<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoSystemObservation
 *
 * @property int $co_obs
 * @property string|null $descricao
 * @property int|null $co_sistema
 * @property string|null $co_usuario
 * @property Carbon|null $dt_obs
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemObservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemObservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemObservation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemObservation whereCoObs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemObservation whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemObservation whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemObservation whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemObservation whereDtObs($value)
 *
 * @mixin \Eloquent
 */
class CaoSystemObservation extends Model
{
    protected $table = 'cao_sistema_obs';

    protected $primaryKey = 'co_obs';

    public $timestamps = false;

    protected $casts = [
        'co_sistema' => 'int',
        'dt_obs' => 'datetime',
    ];

    protected $fillable = [
        'descricao',
        'co_sistema',
        'co_usuario',
        'dt_obs',
    ];
}
