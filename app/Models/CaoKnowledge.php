<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CaoKnowledge
 *
 * @property int $idconhecimento
 * @property string $assunto
 * @property string $conhecimento
 * @property string $url
 * @property string $tags
 * @property string $usuario
 * @property Carbon $datahora
 * @property CaoUser $cao_user
 * @property Collection|CaoKnowledgeSource[] $cao_knowledge_sources
 * @property Collection|CaoKnowledgePoints[] $cao_knowledge_points
 * @property-read int|null $cao_knowledge_points_count
 * @property-read int|null $cao_knowledge_sources_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledge query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledge whereAssunto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledge whereConhecimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledge whereDatahora($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledge whereIdconhecimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledge whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledge whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoKnowledge whereUsuario($value)
 *
 * @mixin \Eloquent
 */
class CaoKnowledge extends Model
{
    protected $table = 'cao_conhecimentos';

    protected $primaryKey = 'idconhecimento';

    public $timestamps = false;

    protected $casts = [
        'datahora' => 'datetime',
    ];

    protected $fillable = [
        'assunto',
        'conhecimento',
        'url',
        'tags',
        'usuario',
        'datahora',
    ];

    public function cao_user(): BelongsTo
    {
        return $this->belongsTo(CaoUser::class, 'usuario');
    }

    public function cao_knowledge_sources(): HasMany
    {
        return $this->hasMany(CaoKnowledgeSource::class, 'idconhecimento');
    }

    public function cao_knowledge_points(): HasMany
    {
        return $this->hasMany(CaoKnowledgePoints::class, 'idconhecimento');
    }
}
