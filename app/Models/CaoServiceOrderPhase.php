<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoServiceOrderPhase
 *
 * @property int $co_fase
 * @property string|null $descricao
 * @property string $descricao_ingl
 * @property int|null $ordem
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderPhase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderPhase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderPhase query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderPhase whereCoFase($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderPhase whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderPhase whereDescricaoIngl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderPhase whereOrdem($value)
 *
 * @mixin \Eloquent
 */
class CaoServiceOrderPhase extends Model
{
    protected $table = 'cao_os_fase';

    protected $primaryKey = 'co_fase';

    public $timestamps = false;

    protected $casts = [
        'ordem' => 'int',
    ];

    protected $fillable = [
        'descricao',
        'descricao_ingl',
        'ordem',
    ];
}
