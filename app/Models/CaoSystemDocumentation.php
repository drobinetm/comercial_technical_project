<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoSystemDocumentation
 *
 * @property int $id
 * @property int $co_sistema
 * @property string|null $descricao
 * @property string $pasta
 * @property int|null $sub_grupo
 * @property string $co_usuario
 * @property Carbon $dt_doc
 * @property string $arquivo
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemDocumentation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemDocumentation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemDocumentation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemDocumentation whereArquivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemDocumentation whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemDocumentation whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemDocumentation whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemDocumentation whereDtDoc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemDocumentation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemDocumentation wherePasta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemDocumentation whereSubGrupo($value)
 *
 * @mixin \Eloquent
 */
class CaoSystemDocumentation extends Model
{
    protected $table = 'cao_documentacao_sistema';

    public $timestamps = false;

    protected $casts = [
        'co_sistema' => 'int',
        'sub_grupo' => 'int',
        'dt_doc' => 'datetime',
    ];

    protected $fillable = [
        'co_sistema',
        'descricao',
        'pasta',
        'sub_grupo',
        'co_usuario',
        'dt_doc',
        'arquivo',
    ];
}
