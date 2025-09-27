<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoSchedulingStatus
 *
 * @property int $co_status_agendamento
 * @property string $ds_status_agendamento
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSchedulingStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSchedulingStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSchedulingStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSchedulingStatus whereCoStatusAgendamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSchedulingStatus whereDsStatusAgendamento($value)
 *
 * @mixin \Eloquent
 */
class CaoSchedulingStatus extends Model
{
    protected $table = 'cao_status_agendamento';

    protected $primaryKey = 'co_status_agendamento';

    public $timestamps = false;

    protected $fillable = [
        'ds_status_agendamento',
    ];
}
