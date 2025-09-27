<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoHelpAuthor
 *
 * @property int $co_autor
 * @property string $no_autor
 * @property int $co_filial
 * @property string|null $nu_ddd1
 * @property string|null $nu_tel1
 * @property string|null $nu_ramal1
 * @property string|null $nu_ddd2
 * @property string|null $nu_tel2
 * @property string|null $nu_ramal2
 * @property string|null $ds_email
 * @property string $ds_funcao
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpAuthor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpAuthor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpAuthor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpAuthor whereCoAutor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpAuthor whereCoFilial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpAuthor whereDsEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpAuthor whereDsFuncao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpAuthor whereNoAutor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpAuthor whereNuDdd1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpAuthor whereNuDdd2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpAuthor whereNuRamal1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpAuthor whereNuRamal2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpAuthor whereNuTel1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpAuthor whereNuTel2($value)
 *
 * @mixin \Eloquent
 */
class CaoHelpAuthor extends Model
{
    protected $table = 'cao_help_autor';

    protected $primaryKey = 'co_autor';

    public $timestamps = false;

    protected $casts = [
        'co_filial' => 'int',
    ];

    protected $fillable = [
        'no_autor',
        'co_filial',
        'nu_ddd1',
        'nu_tel1',
        'nu_ramal1',
        'nu_ddd2',
        'nu_tel2',
        'nu_ramal2',
        'ds_email',
        'ds_funcao',
    ];
}
