<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoDailyReport
 *
 * @property int $co_diary_report
 * @property Carbon|null $hr_gasta
 * @property int $co_atividade
 * @property string $ds_assunto
 * @property int $co_movimento
 * @property int|null $nu_os
 * @property int|null $co_sistema
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDailyReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDailyReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDailyReport query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDailyReport whereCoAtividade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDailyReport whereCoDiaryReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDailyReport whereCoMovimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDailyReport whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDailyReport whereDsAssunto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDailyReport whereHrGasta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoDailyReport whereNuOs($value)
 *
 * @mixin \Eloquent
 */
class CaoDailyReport extends Model
{
    protected $table = 'cao_diary_report';

    protected $primaryKey = 'co_diary_report';

    public $timestamps = false;

    protected $casts = [
        'hr_gasta' => 'datetime',
        'co_atividade' => 'int',
        'co_movimento' => 'int',
        'nu_os' => 'int',
        'co_sistema' => 'int',
    ];

    protected $fillable = [
        'hr_gasta',
        'co_atividade',
        'ds_assunto',
        'co_movimento',
        'nu_os',
        'co_sistema',
    ];
}
