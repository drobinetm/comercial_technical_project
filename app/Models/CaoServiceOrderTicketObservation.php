<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoServiceOrderTicketObservation
 *
 * @property int $co_obs
 * @property int|null $co_chamado
 * @property string|null $co_usuario
 * @property string|null $descricao
 * @property Carbon|null $dt_obs
 * @property string|null $email
 * @property string|null $arquivo_obs
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicketObservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicketObservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicketObservation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicketObservation whereArquivoObs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicketObservation whereCoChamado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicketObservation whereCoObs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicketObservation whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicketObservation whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicketObservation whereDtObs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicketObservation whereEmail($value)
 *
 * @mixin \Eloquent
 */
class CaoServiceOrderTicketObservation extends Model
{
    protected $table = 'cao_os_obs_chamado';

    protected $primaryKey = 'co_obs';

    public $timestamps = false;

    protected $casts = [
        'co_chamado' => 'int',
        'dt_obs' => 'datetime',
    ];

    protected $fillable = [
        'co_chamado',
        'co_usuario',
        'descricao',
        'dt_obs',
        'email',
        'arquivo_obs',
    ];
}
