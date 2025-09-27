<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserType
 *
 * @property int $co_tipo_usuario
 * @property string $ds_tipo_usuario
 * @property int $co_sistema
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserType whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserType whereCoTipoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserType whereDsTipoUsuario($value)
 *
 * @mixin \Eloquent
 */
class UserType extends Model
{
    protected $table = 'tipo_usuario';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'co_tipo_usuario' => 'int',
        'co_sistema' => 'int',
    ];

    protected $fillable = [
        'ds_tipo_usuario',
    ];
}
