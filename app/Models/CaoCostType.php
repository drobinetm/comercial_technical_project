<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoCostType
 *
 * @property int $co_tipo_custo
 * @property string $descricao
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCostType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCostType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCostType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCostType whereCoTipoCusto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCostType whereDescricao($value)
 *
 * @mixin \Eloquent
 */
class CaoCostType extends Model
{
    protected $table = 'cao_tipo_custo';

    protected $primaryKey = 'co_tipo_custo';

    public $timestamps = false;

    protected $fillable = [
        'descricao',
    ];
}
