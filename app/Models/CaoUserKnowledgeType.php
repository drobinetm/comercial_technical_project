<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoUserKnowledgeType
 *
 * @property int $co_conhecimento
 * @property string|null $ds_conhecimento
 * @property int $co_sistema
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserKnowledgeType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserKnowledgeType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserKnowledgeType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserKnowledgeType whereCoConhecimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserKnowledgeType whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserKnowledgeType whereDsConhecimento($value)
 *
 * @mixin \Eloquent
 */
class CaoUserKnowledgeType extends Model
{
    protected $table = 'cao_tipo_conhecimento_usuario';

    protected $primaryKey = 'co_conhecimento';

    public $timestamps = false;

    protected $casts = [
        'co_sistema' => 'int',
    ];

    protected $fillable = [
        'ds_conhecimento',
        'co_sistema',
    ];
}
