<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoServiceOrderDeadline
 *
 * @property int $co_prazo
 * @property int|null $co_os
 * @property int|null $co_fase
 * @property int|null $total_analista
 * @property int|null $total_hora
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDeadline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDeadline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDeadline query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDeadline whereCoFase($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDeadline whereCoOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDeadline whereCoPrazo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDeadline whereTotalAnalista($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderDeadline whereTotalHora($value)
 *
 * @mixin \Eloquent
 */
class CaoServiceOrderDeadline extends Model
{
    protected $table = 'cao_os_prazo';

    protected $primaryKey = 'co_prazo';

    public $timestamps = false;

    protected $casts = [
        'co_os' => 'int',
        'co_fase' => 'int',
        'total_analista' => 'int',
        'total_hora' => 'int',
    ];

    protected $fillable = [
        'co_os',
        'co_fase',
        'total_analista',
        'total_hora',
    ];
}
