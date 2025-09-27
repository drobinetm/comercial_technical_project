<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CaoRankingScale
 *
 * @property int $idescala
 * @property int $qtd_visual
 * @property int $pontuacao
 * @property Collection|CaoKnowledgePoints[] $cao_knowledge_points
 * @property-read int|null $cao_knowledge_points_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoRankingScale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoRankingScale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoRankingScale query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoRankingScale whereIdescala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoRankingScale wherePontuacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoRankingScale whereQtdVisual($value)
 *
 * @mixin \Eloquent
 */
class CaoRankingScale extends Model
{
    protected $table = 'cao_escala_ranking';

    protected $primaryKey = 'idescala';

    public $timestamps = false;

    protected $casts = [
        'qtd_visual' => 'int',
        'pontuacao' => 'int',
    ];

    protected $fillable = [
        'qtd_visual',
        'pontuacao',
    ];

    public function cao_knowledge_points(): HasMany
    {
        return $this->hasMany(CaoKnowledgePoints::class, 'pontuacao');
    }
}
