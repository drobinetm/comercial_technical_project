<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoTimeBank
 *
 * @property int $id
 * @property string $co_usuario
 * @property Carbon $data_cadastro
 * @property int $segundos
 * @property string $tipo
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTimeBank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTimeBank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTimeBank query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTimeBank whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTimeBank whereDataCadastro($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTimeBank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTimeBank whereSegundos($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTimeBank whereTipo($value)
 *
 * @mixin \Eloquent
 */
class CaoTimeBank extends Model
{
    protected $table = 'cao_banco_de_horas';

    public $timestamps = false;

    protected $casts = [
        'data_cadastro' => 'datetime',
        'segundos' => 'int',
    ];

    protected $fillable = [
        'co_usuario',
        'data_cadastro',
        'segundos',
        'tipo',
    ];
}
