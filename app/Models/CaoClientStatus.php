<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoClientStatus
 *
 * @property int $co_status
 * @property string $ds_status
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientStatus whereCoStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientStatus whereDsStatus($value)
 *
 * @mixin \Eloquent
 */
class CaoClientStatus extends Model
{
    protected $table = 'cao_status_cliente';

    protected $primaryKey = 'co_status';

    public $timestamps = false;

    protected $fillable = [
        'ds_status',
    ];
}
