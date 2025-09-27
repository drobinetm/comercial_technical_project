<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoUserAvailabilityDate
 *
 * @property int $co_dt_disp
 * @property string|null $co_usuario
 * @property Carbon $dt_disp
 * @property Carbon $dt_alt
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserAvailabilityDate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserAvailabilityDate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserAvailabilityDate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserAvailabilityDate whereCoDtDisp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserAvailabilityDate whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserAvailabilityDate whereDtAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserAvailabilityDate whereDtDisp($value)
 *
 * @mixin \Eloquent
 */
class CaoUserAvailabilityDate extends Model
{
    protected $table = 'cao_usuario_dt_disp';

    protected $primaryKey = 'co_dt_disp';

    public $timestamps = false;

    protected $casts = [
        'dt_disp' => 'datetime',
        'dt_alt' => 'datetime',
    ];

    protected $fillable = [
        'co_usuario',
        'dt_disp',
        'dt_alt',
    ];
}
