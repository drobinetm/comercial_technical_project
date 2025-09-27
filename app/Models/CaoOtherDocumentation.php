<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoOtherDocumentation
 *
 * @property int $id
 * @property string $nome
 * @property int $co_sistema
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOtherDocumentation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOtherDocumentation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOtherDocumentation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOtherDocumentation whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOtherDocumentation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOtherDocumentation whereNome($value)
 *
 * @mixin \Eloquent
 */
class CaoOtherDocumentation extends Model
{
    protected $table = 'cao_documentacao_outros';

    public $timestamps = false;

    protected $casts = [
        'co_sistema' => 'int',
    ];

    protected $fillable = [
        'nome',
        'co_sistema',
    ];
}
