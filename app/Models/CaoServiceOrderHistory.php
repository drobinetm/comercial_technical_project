<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CaoServiceOrderHistory
 *
 * @property int $idocorrencia
 * @property int|null $co_os
 * @property string|null $co_usuario
 * @property Carbon|null $data
 * @property string $tipo
 * @property string $descricao
 * @property string $responsavel
 * @property Carbon|null $data_fechamento
 * @property CaoUser|null $cao_user
 * @property CaoServiceOrder|null $cao_service_order
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderHistory whereCoOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderHistory whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderHistory whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderHistory whereDataFechamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderHistory whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderHistory whereIdocorrencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderHistory whereResponsavel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderHistory whereTipo($value)
 *
 * @mixin \Eloquent
 */
class CaoServiceOrderHistory extends Model
{
    protected $table = 'cao_hist_ocorrencias_os';

    protected $primaryKey = 'idocorrencia';

    public $timestamps = false;

    protected $casts = [
        'co_os' => 'int',
        'data' => 'datetime',
        'data_fechamento' => 'datetime',
    ];

    protected $fillable = [
        'co_os',
        'co_usuario',
        'data',
        'tipo',
        'descricao',
        'responsavel',
        'data_fechamento',
    ];

    public function cao_user(): BelongsTo
    {
        return $this->belongsTo(CaoUser::class, 'co_usuario');
    }

    public function cao_service_order(): BelongsTo
    {
        return $this->belongsTo(CaoServiceOrder::class, 'co_os');
    }
}
