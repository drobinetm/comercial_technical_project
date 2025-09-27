<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoSalary
 *
 * @property string $co_usuario
 * @property Carbon $dt_alteracao
 * @property float $brut_salario
 * @property float $liq_salario
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalary query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalary whereBrutSalario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalary whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalary whereDtAlteracao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSalary whereLiqSalario($value)
 *
 * @mixin \Eloquent
 */
class CaoSalary extends Model
{
    protected $table = 'cao_salario';

    protected $primaryKey = 'co_usuario';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'dt_alteracao' => 'datetime',
        'brut_salario' => 'float',
        'liq_salario' => 'float',
    ];

    protected $fillable = [
        'co_usuario',
        'brut_salario',
        'liq_salario',
        'dt_alteracao',
    ];
}
