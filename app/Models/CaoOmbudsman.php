<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CaoOmbudsman
 *
 * @property int $id
 * @property int $idtipo
 * @property int $idcategoria
 * @property Carbon $data
 * @property string $comentario
 * @property int $co_escritorio
 * @property CaoOmbudsmanType $cao_ombudsman_type
 * @property CaoOmbudsmanCategories $cao_ombudsman_categories
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsman newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsman newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsman query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsman whereCoEscritorio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsman whereComentario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsman whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsman whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsman whereIdcategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsman whereIdtipo($value)
 *
 * @mixin \Eloquent
 */
class CaoOmbudsman extends Model
{
    protected $table = 'cao_ombudsman';

    public $timestamps = false;

    protected $casts = [
        'idtipo' => 'int',
        'idcategoria' => 'int',
        'data' => 'datetime',
        'co_escritorio' => 'int',
    ];

    protected $fillable = [
        'idtipo',
        'idcategoria',
        'data',
        'comentario',
        'co_escritorio',
    ];

    public function cao_ombudsman_type(): BelongsTo
    {
        return $this->belongsTo(CaoOmbudsmanType::class, 'idtipo');
    }

    public function cao_ombudsman_categories(): BelongsTo
    {
        return $this->belongsTo(CaoOmbudsmanCategories::class, 'idcategoria');
    }
}
