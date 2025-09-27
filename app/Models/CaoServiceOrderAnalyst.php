<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoServiceOrderAnalyst
 *
 * @property int $co_analista
 * @property int|null $co_os
 * @property string|null $co_usuario
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderAnalyst newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderAnalyst newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderAnalyst query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderAnalyst whereCoAnalista($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderAnalyst whereCoOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderAnalyst whereCoUsuario($value)
 *
 * @mixin \Eloquent
 */
class CaoServiceOrderAnalyst extends Model
{
    protected $table = 'cao_os_analista';

    protected $primaryKey = 'co_analista';

    public $timestamps = false;

    protected $casts = [
        'co_os' => 'int',
    ];

    protected $fillable = [
        'co_os',
        'co_usuario',
    ];
}
