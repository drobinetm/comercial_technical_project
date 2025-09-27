<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoBonus
 *
 * @property int $bon_categoria
 * @property int $bon_inicio
 * @property int $bon_fim
 * @property float|null $bon_valor_sem
 * @property float|null $bon_valor_fimsem
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoBonus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoBonus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoBonus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoBonus whereBonCategoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoBonus whereBonFim($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoBonus whereBonInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoBonus whereBonValorFimsem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoBonus whereBonValorSem($value)
 *
 * @mixin \Eloquent
 */
class CaoBonus extends Model
{
    protected $table = 'cao_bonus';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'bon_categoria' => 'int',
        'bon_inicio' => 'int',
        'bon_fim' => 'int',
        'bon_valor_sem' => 'float',
        'bon_valor_fimsem' => 'float',
    ];

    protected $fillable = [
        'bon_valor_sem',
        'bon_valor_fimsem',
    ];
}
