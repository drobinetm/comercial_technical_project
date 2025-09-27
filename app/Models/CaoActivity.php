<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoActivity
 *
 * @property int $co_atividade
 * @property string $ds_atividade
 * @property int $co_tipo_usuario
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivity query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivity whereCoAtividade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivity whereCoTipoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivity whereDsAtividade($value)
 *
 * @mixin \Eloquent
 */
class CaoActivity extends Model
{
    protected $table = 'cao_atividade';

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
