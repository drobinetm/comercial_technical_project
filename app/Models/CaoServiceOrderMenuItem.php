<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoServiceOrderMenuItem
 *
 * @property int $co_item
 * @property string $ds_item
 * @property int $co_sistema
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMenuItem whereCoItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMenuItem whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderMenuItem whereDsItem($value)
 *
 * @mixin \Eloquent
 */
class CaoServiceOrderMenuItem extends Model
{
    protected $table = 'cao_os_item_menu';

    protected $primaryKey = 'co_item';

    public $timestamps = false;

    protected $casts = [
        'co_sistema' => 'int',
    ];

    protected $fillable = [
        'ds_item',
        'co_sistema',
    ];
}
