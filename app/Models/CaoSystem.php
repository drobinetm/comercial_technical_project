<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoSystem
 *
 * @property int $co_sistema
 * @property int|null $co_cliente
 * @property string|null $co_usuario
 * @property int|null $co_arquitetura
 * @property string|null $no_sistema
 * @property string|null $ds_sistema_resumo
 * @property string|null $ds_caracteristica
 * @property string|null $ds_requisito
 * @property string|null $no_diretoria_solic
 * @property string|null $ddd_telefone_solic
 * @property string|null $nu_telefone_solic
 * @property string|null $no_usuario_solic
 * @property Carbon|null $dt_solicitacao
 * @property Carbon|null $dt_entrega
 * @property int|null $co_email
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereCoArquitetura($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereCoCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereCoEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereDddTelefoneSolic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereDsCaracteristica($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereDsRequisito($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereDsSistemaResumo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereDtEntrega($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereDtSolicitacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereNoDiretoriaSolic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereNoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereNoUsuarioSolic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystem whereNuTelefoneSolic($value)
 *
 * @mixin \Eloquent
 */
class CaoSystem extends Model
{
    protected $table = 'cao_sistema';

    protected $primaryKey = 'co_sistema';

    public $timestamps = false;

    protected $casts = [
        'co_cliente' => 'int',
        'co_arquitetura' => 'int',
        'dt_solicitacao' => 'datetime',
        'dt_entrega' => 'datetime',
        'co_email' => 'int',
    ];

    protected $fillable = [
        'co_cliente',
        'co_usuario',
        'co_arquitetura',
        'no_sistema',
        'ds_sistema_resumo',
        'ds_caracteristica',
        'ds_requisito',
        'no_diretoria_solic',
        'ddd_telefone_solic',
        'nu_telefone_solic',
        'no_usuario_solic',
        'dt_solicitacao',
        'dt_entrega',
        'co_email',
    ];
}
