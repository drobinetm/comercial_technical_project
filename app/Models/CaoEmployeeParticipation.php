<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoEmployeeParticipation
 *
 * @property int $co_part_funcionario
 * @property float $pc_participacao
 * @property string $co_usuario
 * @property int $co_escritorio
 * @property Carbon $dt_referencia
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoEmployeeParticipation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoEmployeeParticipation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoEmployeeParticipation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoEmployeeParticipation whereCoEscritorio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoEmployeeParticipation whereCoPartFuncionario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoEmployeeParticipation whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoEmployeeParticipation whereDtReferencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoEmployeeParticipation wherePcParticipacao($value)
 *
 * @mixin \Eloquent
 */
class CaoEmployeeParticipation extends Model
{
    protected $table = 'cao_participacao_funcionario';

    protected $primaryKey = 'co_part_funcionario';

    public $timestamps = false;

    protected $casts = [
        'pc_participacao' => 'float',
        'co_escritorio' => 'int',
        'dt_referencia' => 'datetime',
    ];

    protected $fillable = [
        'pc_participacao',
        'co_usuario',
        'co_escritorio',
        'dt_referencia',
    ];
}
