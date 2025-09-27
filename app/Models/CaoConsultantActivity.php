<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoConsultantActivity
 *
 * @property int $co_atividade
 * @property string $ds_atividade
 * @property string|null $ativo
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantActivity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantActivity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantActivity query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantActivity whereAtivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantActivity whereCoAtividade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoConsultantActivity whereDsAtividade($value)
 *
 * @mixin \Eloquent
 */
class CaoConsultantActivity extends Model
{
    protected $table = 'cao_atividade_consultor';

    protected $primaryKey = 'co_atividade';

    public $timestamps = false;

    protected $fillable = [
        'ds_atividade',
        'ativo',
    ];
}
