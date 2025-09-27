<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoUserSystemType
 *
 * @property int $co_sistema
 * @property string|null $ds_sistema
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserSystemType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserSystemType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserSystemType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserSystemType whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserSystemType whereDsSistema($value)
 *
 * @mixin \Eloquent
 */
class CaoUserSystemType extends Model
{
    protected $table = 'cao_tipo_sistema_usuario';

    protected $primaryKey = 'co_sistema';

    public $timestamps = false;

    protected $fillable = [
        'ds_sistema',
    ];
}
