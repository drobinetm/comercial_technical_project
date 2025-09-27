<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoRestValue
 *
 * @property int $id
 * @property string $co_usuario
 * @property string $segundos
 * @property string $mes_referencia
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoRestValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoRestValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoRestValue query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoRestValue whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoRestValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoRestValue whereMesReferencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoRestValue whereSegundos($value)
 *
 * @mixin \Eloquent
 */
class CaoRestValue extends Model
{
    protected $table = 'cao_valor_descanso';

    public $timestamps = false;

    protected $fillable = [
        'co_usuario',
        'segundos',
        'mes_referencia',
    ];
}
