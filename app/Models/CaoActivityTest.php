<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoActivityTest
 *
 * @property int $co_atividade
 * @property string $ds_atividade
 * @property int $co_tipo_usuario
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityTest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityTest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityTest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityTest whereCoAtividade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityTest whereCoTipoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityTest whereDsAtividade($value)
 *
 * @mixin \Eloquent
 */
class CaoActivityTest extends Model
{
    protected $table = 'cao_atividade_teste';

    protected $primaryKey = 'co_atividade';

    public $timestamps = false;

    protected $casts = [
        'co_tipo_usuario' => 'int',
    ];

    protected $fillable = [
        'ds_atividade',
        'co_tipo_usuario',
    ];
}
