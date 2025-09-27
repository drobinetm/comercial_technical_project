<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoHelpTicket
 *
 * @property int $co_chamado
 * @property string $ds_chamado
 * @property string|null $ds_solucao
 * @property int $co_status
 * @property int $co_motivo
 * @property int $co_tela
 * @property int $co_autor
 * @property int $co_filial
 * @property int $co_sistema
 * @property Carbon $dt_chamado
 * @property Carbon|null $dt_solucao
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicket query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicket whereCoAutor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicket whereCoChamado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicket whereCoFilial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicket whereCoMotivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicket whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicket whereCoStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicket whereCoTela($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicket whereDsChamado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicket whereDsSolucao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicket whereDtChamado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicket whereDtSolucao($value)
 *
 * @mixin \Eloquent
 */
class CaoHelpTicket extends Model
{
    protected $table = 'cao_help_chamado';

    protected $primaryKey = 'co_chamado';

    public $timestamps = false;

    protected $casts = [
        'co_status' => 'int',
        'co_motivo' => 'int',
        'co_tela' => 'int',
        'co_autor' => 'int',
        'co_filial' => 'int',
        'co_sistema' => 'int',
        'dt_chamado' => 'datetime',
        'dt_solucao' => 'datetime',
    ];

    protected $fillable = [
        'ds_chamado',
        'ds_solucao',
        'co_status',
        'co_motivo',
        'co_tela',
        'co_autor',
        'co_filial',
        'co_sistema',
        'dt_chamado',
        'dt_solucao',
    ];
}
