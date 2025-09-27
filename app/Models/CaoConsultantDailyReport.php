<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoConsultantDailyReport
 *
 * @property int $co_diary_report_consultor
 * @property int $co_movimento
 * @property int $co_atividade
 * @property string $ds_empresa
 * @property string $ds_assunto
 * @property Carbon $dt_agendamento
 * @property Carbon|null $dt_agendamento_fim
 * @property float $vl_fechamento
 * @property int|null $co_cliente
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantDailyReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantDailyReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantDailyReport query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantDailyReport whereCoAtividade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantDailyReport whereCoCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantDailyReport whereCoDiaryReportConsultor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantDailyReport whereCoMovimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantDailyReport whereDsAssunto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantDailyReport whereDsEmpresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantDailyReport whereDtAgendamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantDailyReport whereDtAgendamentoFim($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantDailyReport whereVlFechamento($value)
 *
 * @mixin \Eloquent
 */
class CaoConsultantDailyReport extends Model
{
    protected $table = 'cao_diary_report_consultor';

    protected $primaryKey = 'co_diary_report_consultor';

    public $timestamps = false;

    protected $casts = [
        'co_movimento' => 'int',
        'co_atividade' => 'int',
        'dt_agendamento' => 'datetime',
        'dt_agendamento_fim' => 'datetime',
        'vl_fechamento' => 'float',
        'co_cliente' => 'int',
    ];

    protected $fillable = [
        'co_movimento',
        'co_atividade',
        'ds_empresa',
        'ds_assunto',
        'dt_agendamento',
        'dt_agendamento_fim',
        'vl_fechamento',
        'co_cliente',
    ];
}
