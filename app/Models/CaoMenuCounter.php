<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoMenuCounter
 *
 * @property string $co_usuario
 * @property int $co_menu
 * @property int $nu_pontos
 * @property int $in_processado
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMenuCounter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMenuCounter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMenuCounter query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMenuCounter whereCoMenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMenuCounter whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMenuCounter whereInProcessado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMenuCounter whereNuPontos($value)
 *
 * @mixin \Eloquent
 */
class CaoMenuCounter extends Model
{
    protected $table = 'cao_menu_contador';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'co_menu' => 'int',
        'nu_pontos' => 'int',
        'in_processado' => 'int',
    ];

    protected $fillable = [
        'nu_pontos',
        'in_processado',
    ];
}
