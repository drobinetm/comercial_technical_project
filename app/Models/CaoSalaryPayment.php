<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CaoSalaryPayment
 *
 * @property int $id_pagamento
 * @property string $co_usuario
 * @property Carbon $dt_efetuado
 * @property string $status
 * @property string|null $observacao
 * @property CaoUser $cao_user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalaryPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalaryPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalaryPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalaryPayment whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalaryPayment whereDtEfetuado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalaryPayment whereIdPagamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalaryPayment whereObservacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalaryPayment whereStatus($value)
 *
 * @mixin \Eloquent
 */
class CaoSalaryPayment extends Model
{
    protected $table = 'cao_salario_pag';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'id_pagamento' => 'int',
        'dt_efetuado' => 'datetime',
    ];

    protected $fillable = [
        'id_pagamento',
        'status',
        'observacao',
    ];

    public function cao_user(): BelongsTo
    {
        return $this->belongsTo(CaoUser::class, 'co_usuario');
    }
}
