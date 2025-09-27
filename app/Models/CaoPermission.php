<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoPermission
 *
 * @property string $co_usuario
 * @property string $permissao_intervalo
 * @property string $permissao_hora_extra
 * @property CaoUser $cao_user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPermission whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPermission wherePermissaoHoraExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoPermission wherePermissaoIntervalo($value)
 *
 * @mixin \Eloquent
 */
class CaoPermission extends Model
{
    protected $table = 'cao_permissao';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'co_usuario',
        'permissao_intervalo',
        'permissao_hora_extra',
    ];

    public function cao_user()
    {
        return $this->belongsTo(CaoUser::class, 'co_usuario');
    }
}
