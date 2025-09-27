<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoService
 *
 * @property int $co_servico
 * @property string $ds_servico
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoService query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoService whereCoServico($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoService whereDsServico($value)
 *
 * @mixin \Eloquent
 */
class CaoService extends Model
{
    protected $table = 'cao_servico';

    protected $primaryKey = 'co_servico';

    public $timestamps = false;

    protected $fillable = [
        'ds_servico',
    ];
}
