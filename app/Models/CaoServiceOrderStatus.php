<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoServiceOrderStatus
 *
 * @property int $co_status_atual
 * @property string $ds_status
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderStatus whereCoStatusAtual($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderStatus whereDsStatus($value)
 *
 * @mixin \Eloquent
 */
class CaoServiceOrderStatus extends Model
{
    protected $table = 'cao_status_os';

    protected $primaryKey = 'co_status_atual';

    public $timestamps = false;

    protected $fillable = [
        'ds_status',
    ];
}
