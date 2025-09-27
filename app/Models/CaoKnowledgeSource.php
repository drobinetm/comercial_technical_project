<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CaoKnowledgeSource
 *
 * @property int $idfonte
 * @property int $idconhecimento
 * @property Carbon $datahora
 * @property string $arquivo
 * @property string $caminho
 * @property CaoKnowledge $cao_knowledge
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgeSource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgeSource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgeSource query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgeSource whereArquivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgeSource whereCaminho($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgeSource whereDatahora($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgeSource whereIdconhecimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgeSource whereIdfonte($value)
 *
 * @mixin \Eloquent
 */
class CaoKnowledgeSource extends Model
{
    protected $table = 'cao_conhecimentos_fontes';

    protected $primaryKey = 'idfonte';

    public $timestamps = false;

    protected $casts = [
        'idconhecimento' => 'int',
        'datahora' => 'datetime',
    ];

    protected $fillable = [
        'idconhecimento',
        'datahora',
        'arquivo',
        'caminho',
    ];

    public function cao_knowledge(): BelongsTo
    {
        return $this->belongsTo(CaoKnowledge::class, 'idconhecimento');
    }
}
