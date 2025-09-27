<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SystemPermission
 *
 * @property string $co_usuario
 * @property int $co_tipo_usuario
 * @property int $co_sistema
 * @property string $in_ativo
 * @property string|null $co_usuario_atualizacao
 * @property Carbon $dt_atualizacao
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemPermission whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemPermission whereCoTipoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemPermission whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemPermission whereCoUsuarioAtualizacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemPermission whereDtAtualizacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemPermission whereInAtivo($value)
 *
 * @mixin \Eloquent
 */
class SystemPermission extends Model
{
    protected $table = 'permissao_sistema';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'co_tipo_usuario' => 'int',
        'co_sistema' => 'int',
        'dt_atualizacao' => 'datetime',
    ];

    protected $fillable = [
        'in_ativo',
        'co_usuario_atualizacao',
        'dt_atualizacao',
    ];
}
