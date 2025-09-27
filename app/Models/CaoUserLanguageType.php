<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoUserLanguageType
 *
 * @property int $co_idioma
 * @property string|null $ds_idioma
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserLanguageType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserLanguageType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserLanguageType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserLanguageType whereCoIdioma($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserLanguageType whereDsIdioma($value)
 *
 * @mixin \Eloquent
 */
class CaoUserLanguageType extends Model
{
    protected $table = 'cao_tipo_idioma_usuario';

    protected $primaryKey = 'co_idioma';

    public $timestamps = false;

    protected $fillable = [
        'ds_idioma',
    ];
}
