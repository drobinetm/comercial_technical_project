<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoMovementJustification
 *
 * @property int $co_movimento_justificativa
 * @property int $co_movimento
 * @property int $nu_os
 * @property string $ds_justificativa
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovementJustification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovementJustification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovementJustification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovementJustification whereCoMovimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovementJustification whereCoMovimentoJustificativa($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovementJustification whereDsJustificativa($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoMovementJustification whereNuOs($value)
 *
 * @mixin \Eloquent
 */
class CaoMovementJustification extends Model
{
    protected $table = 'cao_movimento_justificativa';

    protected $primaryKey = 'co_movimento_justificativa';

    public $timestamps = false;

    protected $casts = [
        'co_movimento' => 'int',
        'nu_os' => 'int',
    ];

    protected $fillable = [
        'co_movimento',
        'nu_os',
        'ds_justificativa',
    ];
}
