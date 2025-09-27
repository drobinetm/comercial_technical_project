<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoServiceOrderTicket
 *
 * @property int $co_chamado
 * @property int $co_sistema
 * @property int $co_os
 * @property string $ds_chamado
 * @property int $co_tipo
 * @property int $co_prioridade
 * @property int $co_item
 * @property string $descricao
 * @property string $ds_solucao
 * @property string $tempo
 * @property Carbon $dt_chamado
 * @property int $status
 * @property string $co_usuario
 * @property string $co_analista
 * @property string|null $email
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereCoAnalista($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereCoChamado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereCoItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereCoOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereCoPrioridade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereCoTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereDsChamado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereDsSolucao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereDtChamado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderTicket whereTempo($value)
 *
 * @mixin \Eloquent
 */
class CaoServiceOrderTicket extends Model
{
    protected $table = 'cao_os_chamado';

    protected $primaryKey = 'co_chamado';

    public $timestamps = false;

    protected $casts = [
        'co_sistema' => 'int',
        'co_os' => 'int',
        'co_tipo' => 'int',
        'co_prioridade' => 'int',
        'co_item' => 'int',
        'dt_chamado' => 'datetime',
        'status' => 'int',
    ];

    protected $fillable = [
        'co_sistema',
        'co_os',
        'ds_chamado',
        'co_tipo',
        'co_prioridade',
        'co_item',
        'descricao',
        'ds_solucao',
        'tempo',
        'dt_chamado',
        'status',
        'co_usuario',
        'co_analista',
        'email',
    ];
}
