<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoClientStatusComplement
 *
 * @property int $co_complemento_status
 * @property string|null $ds_status
 * @property int|null $co_status
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientStatusComplement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientStatusComplement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientStatusComplement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientStatusComplement whereCoComplementoStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientStatusComplement whereCoStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClientStatusComplement whereDsStatus($value)
 *
 * @mixin \Eloquent
 */
class CaoClientStatusComplement extends Model
{
    protected $table = 'cao_status_cliente_complemento';

    protected $primaryKey = 'co_complemento_status';

    public $timestamps = false;

    protected $casts = [
        'co_status' => 'int',
    ];

    protected $fillable = [
        'ds_status',
        'co_status',
    ];
}
