<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CaoKnowledgePoints
 *
 * @property int $idpontos
 * @property int $pontuacao
 * @property string $co_coordenador
 * @property int $idconhecimento
 * @property CaoRankingScale $cao_ranking_scale
 * @property CaoUser $cao_user
 * @property CaoKnowledge $cao_knowledge
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgePoints newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgePoints newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgePoints query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgePoints whereCoCoordenador($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgePoints whereIdconhecimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgePoints whereIdpontos($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledgePoints wherePontuacao($value)
 *
 * @mixin \Eloquent
 */
class CaoKnowledgePoints extends Model
{
    protected $table = 'cao_pontos_conhecimento';

    protected $primaryKey = 'idpontos';

    public $timestamps = false;

    protected $casts = [
        'pontuacao' => 'int',
        'idconhecimento' => 'int',
    ];

    protected $fillable = [
        'pontuacao',
        'co_coordenador',
        'idconhecimento',
    ];

    public function cao_ranking_scale(): BelongsTo
    {
        return $this->belongsTo(CaoRankingScale::class, 'pontuacao');
    }

    public function cao_user(): BelongsTo
    {
        return $this->belongsTo(CaoUser::class, 'co_coordenador');
    }

    public function cao_knowledge(): BelongsTo
    {
        return $this->belongsTo(CaoKnowledge::class, 'idconhecimento');
    }
}
