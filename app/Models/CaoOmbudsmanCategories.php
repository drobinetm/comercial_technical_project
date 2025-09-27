<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CaoOmbudsmanCategories
 *
 * @property int $idcategoria
 * @property string $descricao
 * @property Collection|CaoOmbudsman[] $cao_ombudsmen
 * @property-read int|null $cao_ombudsmen_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsmanCategories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsmanCategories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsmanCategories query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsmanCategories whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsmanCategories whereIdcategoria($value)
 *
 * @mixin \Eloquent
 */
class CaoOmbudsmanCategories extends Model
{
    protected $table = 'cao_categorias_ombudsman';

    protected $primaryKey = 'idcategoria';

    public $timestamps = false;

    protected $fillable = [
        'descricao',
    ];

    public function cao_ombudsmen(): HasMany
    {
        return $this->hasMany(CaoOmbudsman::class, 'idcategoria');
    }
}
