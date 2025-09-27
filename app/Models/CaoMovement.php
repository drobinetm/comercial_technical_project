<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoMovement
 *
 * @property int $co_movimento
 * @property string $co_usuario
 * @property Carbon $dt_entrada
 * @property Carbon $dt_saida_almoco
 * @property Carbon $dt_volta_almoco
 * @property Carbon $dt_saida
 * @property int $is_encerrado
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovement whereCoMovimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovement whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovement whereDtEntrada($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovement whereDtSaida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovement whereDtSaidaAlmoco($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovement whereDtVoltaAlmoco($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovement whereIsEncerrado($value)
 *
 * @mixin \Eloquent
 */
class CaoMovement extends Model
{
    protected $table = 'cao_movimento';

    protected $primaryKey = 'co_movimento';

    public $timestamps = false;

    protected $casts = [
        'dt_entrada' => 'datetime',
        'dt_saida_almoco' => 'datetime',
        'dt_volta_almoco' => 'datetime',
        'dt_saida' => 'datetime',
        'is_encerrado' => 'int',
    ];

    protected $fillable = [
        'co_usuario',
        'dt_entrada',
        'dt_saida_almoco',
        'dt_volta_almoco',
        'dt_saida',
        'is_encerrado',
    ];
}
