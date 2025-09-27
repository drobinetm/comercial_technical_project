<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CaoOmbudsmanType
 *
 * @property int $idtipo
 * @property string $descricao
 * @property Collection|CaoOmbudsman[] $cao_ombudsmen
 * @property-read int|null $cao_ombudsmen_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsmanType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsmanType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsmanType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsmanType whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOmbudsmanType whereIdtipo($value)
 *
 * @mixin \Eloquent
 */
class CaoOmbudsmanType extends Model
{
    protected $table = 'cao_tipo_ombudsman';

    protected $primaryKey = 'idtipo';

    public $timestamps = false;

    protected $fillable = [
        'descricao',
    ];

    public function cao_ombudsmen(): HasMany
    {
        return $this->hasMany(CaoOmbudsman::class, 'idtipo');
    }
}
