<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoNews
 *
 * @property int $co_noticia
 * @property string $assunto
 * @property string $descricao
 * @property string $foto
 * @property string $co_usuario
 * @property Carbon $dt_noticia
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoNews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoNews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoNews query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoNews whereAssunto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoNews whereCoNoticia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoNews whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoNews whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoNews whereDtNoticia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoNews whereFoto($value)
 *
 * @mixin \Eloquent
 */
class CaoNews extends Model
{
    protected $table = 'cao_noticia';

    protected $primaryKey = 'co_noticia';

    public $timestamps = false;

    protected $casts = [
        'dt_noticia' => 'datetime',
    ];

    protected $fillable = [
        'assunto',
        'descricao',
        'foto',
        'co_usuario',
        'dt_noticia',
    ];
}
