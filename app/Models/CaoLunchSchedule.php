<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoLunchSchedule
 *
 * @property string $co_usuario
 * @property string $almoco_saida_hora
 * @property string $almoco_volta_hora
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoLunchSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoLunchSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoLunchSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoLunchSchedule whereAlmocoSaidaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoLunchSchedule whereAlmocoVoltaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoLunchSchedule whereCoUsuario($value)
 *
 * @mixin \Eloquent
 */
class CaoLunchSchedule extends Model
{
    protected $table = 'cao_horario_almoco';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'co_usuario',
        'almoco_saida_hora',
        'almoco_volta_hora',
    ];
}
