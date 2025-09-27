<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoUserTraining
 *
 * @property string $co_usuario
 * @property string $tp_curso
 * @property string|null $ds_curso
 * @property string|null $ds_instituicao
 * @property Carbon|null $dt_conclusao
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserTraining newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserTraining newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserTraining query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserTraining whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserTraining whereDsCurso($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserTraining whereDsInstituicao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserTraining whereDtConclusao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserTraining whereTpCurso($value)
 *
 * @mixin \Eloquent
 */
class CaoUserTraining extends Model
{
    protected $table = 'cao_formacao_usuario';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'dt_conclusao' => 'datetime',
    ];

    protected $fillable = [
        'ds_curso',
        'ds_instituicao',
        'dt_conclusao',
    ];
}
