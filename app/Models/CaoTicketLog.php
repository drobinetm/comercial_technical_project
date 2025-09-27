<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoTicketLog
 *
 * @property int $id
 * @property int $co_chamado
 * @property Carbon $dt_chamado
 * @property string $co_usuario
 * @property int $co_daily
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicketLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicketLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicketLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicketLog whereCoChamado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicketLog whereCoDaily($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicketLog whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicketLog whereDtChamado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicketLog whereId($value)
 *
 * @mixin \Eloquent
 */
class CaoTicketLog extends Model
{
    protected $table = 'cao_log_chamado';

    public $timestamps = false;

    protected $casts = [
        'co_chamado' => 'int',
        'dt_chamado' => 'datetime',
        'co_daily' => 'int',
    ];

    protected $fillable = [
        'co_chamado',
        'dt_chamado',
        'co_usuario',
        'co_daily',
    ];
}
