<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoHoliday
 *
 * @property int|null $dia
 * @property int|null $mes
 * @property int|null $ano
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHoliday newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHoliday newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHoliday query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHoliday whereAno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHoliday whereDia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHoliday whereMes($value)
 *
 * @mixin \Eloquent
 */
class CaoHoliday extends Model
{
    protected $table = 'cao_feriados';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'dia' => 'int',
        'mes' => 'int',
        'ano' => 'int',
    ];

    protected $fillable = [
        'dia',
        'mes',
        'ano',
    ];
}
