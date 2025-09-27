<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoDrActivityComp
 *
 * @property int $id_ativ_comp
 * @property string $co_usuario
 * @property Carbon $data
 * @property string $assunto
 * @property Carbon $tempo_gasto
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDrActivityComp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDrActivityComp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDrActivityComp query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDrActivityComp whereAssunto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDrActivityComp whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDrActivityComp whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDrActivityComp whereIdAtivComp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDrActivityComp whereTempoGasto($value)
 *
 * @mixin \Eloquent
 */
class CaoDrActivityComp extends Model
{
    protected $table = 'cao_dr_ativ_comp';

    protected $primaryKey = 'id_ativ_comp';

    public $timestamps = false;

    protected $casts = [
        'data' => 'datetime',
        'tempo_gasto' => 'datetime',
    ];

    protected $fillable = [
        'co_usuario',
        'data',
        'assunto',
        'tempo_gasto',
    ];
}
