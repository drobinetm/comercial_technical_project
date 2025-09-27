<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoClientContact
 *
 * @property int $co_cliente
 * @property Carbon|null $dt_contato
 * @property int|null $fg_agendado
 * @property Carbon|null $hr_ini
 * @property Carbon|null $hr_end
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientContact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientContact whereCoCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientContact whereDtContato($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientContact whereFgAgendado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientContact whereHrEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientContact whereHrIni($value)
 *
 * @mixin \Eloquent
 */
class CaoClientContact extends Model
{
    protected $table = 'cao_cliente_contato';

    protected $primaryKey = 'co_cliente';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'co_cliente' => 'int',
        'dt_contato' => 'datetime',
        'fg_agendado' => 'int',
        'hr_ini' => 'datetime',
        'hr_end' => 'datetime',
    ];

    protected $fillable = [
        'dt_contato',
        'fg_agendado',
        'hr_ini',
        'hr_end',
    ];
}
