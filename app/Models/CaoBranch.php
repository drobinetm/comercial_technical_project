<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoBranch
 *
 * @property int $co_ramo
 * @property string $ds_ramo
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoBranch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoBranch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoBranch query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoBranch whereCoRamo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoBranch whereDsRamo($value)
 *
 * @mixin \Eloquent
 */
class CaoBranch extends Model
{
    protected $table = 'cao_ramo';

    protected $primaryKey = 'co_ramo';

    public $timestamps = false;

    protected $fillable = [
        'ds_ramo',
    ];
}
