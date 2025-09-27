<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoCommission
 *
 * @property int $co_comissao
 * @property int $co_fatura
 * @property Carbon $dt_efetuado
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCommission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCommission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCommission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCommission whereCoComissao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCommission whereCoFatura($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCommission whereDtEfetuado($value)
 *
 * @mixin \Eloquent
 */
class CaoCommission extends Model
{
    protected $table = 'cao_comissao';

    protected $primaryKey = 'co_comissao';

    public $timestamps = false;

    protected $casts = [
        'co_fatura' => 'int',
        'dt_efetuado' => 'datetime',
    ];

    protected $fillable = [
        'co_fatura',
        'dt_efetuado',
    ];
}
