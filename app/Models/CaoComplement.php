<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoComplement
 *
 * @property int $co_complemento
 * @property string|null $ds_complemento
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoComplement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoComplement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoComplement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoComplement whereCoComplemento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoComplement whereDsComplemento($value)
 *
 * @mixin \Eloquent
 */
class CaoComplement extends Model
{
    protected $table = 'cao_complemento';

    protected $primaryKey = 'co_complemento';

    public $timestamps = false;

    protected $fillable = [
        'ds_complemento',
    ];
}
