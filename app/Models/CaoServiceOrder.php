<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CaoServiceOrder
 *
 * @property int $co_os
 * @property int|null $nu_os
 * @property int|null $co_sistema
 * @property string|null $co_usuario
 * @property int|null $co_arquitetura
 * @property string|null $ds_os
 * @property string|null $ds_caracteristica
 * @property string|null $ds_requisito
 * @property Carbon|null $dt_inicio
 * @property Carbon|null $dt_fim
 * @property int|null $co_status
 * @property string|null $diretoria_sol
 * @property Carbon|null $dt_sol
 * @property string|null $nu_tel_sol
 * @property string|null $ddd_tel_sol
 * @property string|null $nu_tel_sol2
 * @property string|null $ddd_tel_sol2
 * @property string|null $usuario_sol
 * @property Carbon|null $dt_imp
 * @property Carbon|null $dt_garantia
 * @property int|null $co_email
 * @property int|null $co_os_prospect_rel
 * @property Collection|CaoServiceOrderHistory[] $cao_service_order_histories
 * @property-read int|null $cao_service_order_histories_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereCoArquitetura($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereCoEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereCoOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereCoOsProspectRel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereCoStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereDddTelSol($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereDddTelSol2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereDiretoriaSol($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereDsCaracteristica($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereDsOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereDsRequisito($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereDtFim($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereDtGarantia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereDtImp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereDtInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereDtSol($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereNuOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereNuTelSol($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereNuTelSol2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrder whereUsuarioSol($value)
 *
 * @mixin \Eloquent
 */
class CaoServiceOrder extends Model
{
    protected $table = 'cao_os';

    protected $primaryKey = 'co_os';

    public $timestamps = false;

    protected $casts = [
        'nu_os' => 'int',
        'co_sistema' => 'int',
        'co_arquitetura' => 'int',
        'dt_inicio' => 'datetime',
        'dt_fim' => 'datetime',
        'co_status' => 'int',
        'dt_sol' => 'datetime',
        'dt_imp' => 'datetime',
        'dt_garantia' => 'datetime',
        'co_email' => 'int',
        'co_os_prospect_rel' => 'int',
    ];

    protected $fillable = [
        'nu_os',
        'co_sistema',
        'co_usuario',
        'co_arquitetura',
        'ds_os',
        'ds_caracteristica',
        'ds_requisito',
        'dt_inicio',
        'dt_fim',
        'co_status',
        'diretoria_sol',
        'dt_sol',
        'nu_tel_sol',
        'ddd_tel_sol',
        'nu_tel_sol2',
        'ddd_tel_sol2',
        'usuario_sol',
        'dt_imp',
        'dt_garantia',
        'co_email',
        'co_os_prospect_rel',
    ];

    public function cao_service_order_histories(): HasMany
    {
        return $this->hasMany(CaoServiceOrderHistory::class, 'co_os');
    }
}
