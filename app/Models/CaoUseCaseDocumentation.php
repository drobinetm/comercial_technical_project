<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoUseCaseDocumentation
 *
 * @property int $id
 * @property string $nome
 * @property int $co_sistema
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUseCaseDocumentation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUseCaseDocumentation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUseCaseDocumentation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUseCaseDocumentation whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUseCaseDocumentation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUseCaseDocumentation whereNome($value)
 *
 * @mixin \Eloquent
 */
class CaoUseCaseDocumentation extends Model
{
    protected $table = 'cao_documentacao_casos_uso';

    public $timestamps = false;

    protected $casts = [
        'co_sistema' => 'int',
    ];

    protected $fillable = [
        'nome',
        'co_sistema',
    ];
}
