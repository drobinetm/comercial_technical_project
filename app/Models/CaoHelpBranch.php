<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoHelpBranch
 *
 * @property int $co_filial
 * @property string $no_filial
 * @property int $co_cliente
 * @property string $estado
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpBranch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpBranch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpBranch query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpBranch whereCoCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpBranch whereCoFilial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpBranch whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpBranch whereNoFilial($value)
 *
 * @mixin \Eloquent
 */
class CaoHelpBranch extends Model
{
    protected $table = 'cao_help_filial';

    protected $primaryKey = 'co_filial';

    public $timestamps = false;

    protected $casts = [
        'co_cliente' => 'int',
    ];

    protected $fillable = [
        'no_filial',
        'co_cliente',
        'estado',
    ];
}
