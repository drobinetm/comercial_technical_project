<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoScheduling
 *
 * @property int $co_agendamento
 * @property Carbon $dt_hr_inicio
 * @property Carbon|null $dt_hr_fim
 * @property int $co_status_agendamento
 * @property int $co_diary_report_consultor
 * @property int $co_complemento
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoScheduling newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoScheduling newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoScheduling query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoScheduling whereCoAgendamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoScheduling whereCoComplemento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoScheduling whereCoDiaryReportConsultor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoScheduling whereCoStatusAgendamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoScheduling whereDtHrFim($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoScheduling whereDtHrInicio($value)
 *
 * @mixin \Eloquent
 */
class CaoScheduling extends Model
{
    protected $table = 'cao_agendamento';

    protected $primaryKey = 'co_agendamento';

    public $timestamps = false;

    protected $casts = [
        'dt_hr_inicio' => 'datetime',
        'dt_hr_fim' => 'datetime',
        'co_status_agendamento' => 'int',
        'co_diary_report_consultor' => 'int',
        'co_complemento' => 'int',
    ];

    protected $fillable = [
        'dt_hr_inicio',
        'dt_hr_fim',
        'co_status_agendamento',
        'co_diary_report_consultor',
        'co_complemento',
    ];
}
