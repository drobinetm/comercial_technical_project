<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoUserLanguageTraining
 *
 * @property string $co_usuario
 * @property int $co_idioma
 * @property int|null $nv_leitura
 * @property int|null $nv_escrita
 * @property int|null $nv_fala
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserLanguageTraining newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserLanguageTraining newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserLanguageTraining query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserLanguageTraining whereCoIdioma($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserLanguageTraining whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserLanguageTraining whereNvEscrita($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserLanguageTraining whereNvFala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserLanguageTraining whereNvLeitura($value)
 *
 * @mixin \Eloquent
 */
class CaoUserLanguageTraining extends Model
{
    protected $table = 'cao_formacao_idioma_usuario';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'co_idioma' => 'int',
        'nv_leitura' => 'int',
        'nv_escrita' => 'int',
        'nv_fala' => 'int',
    ];

    protected $fillable = [
        'nv_leitura',
        'nv_escrita',
        'nv_fala',
    ];
}
