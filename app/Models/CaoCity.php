<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoCity
 *
 * @property int $co_cidade
 * @property string $no_cidade
 * @property int $co_uf
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCity query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCity whereCoCidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCity whereCoUf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoCity whereNoCidade($value)
 *
 * @mixin \Eloquent
 */
class CaoCity extends Model
{
    protected $table = 'cao_cidade';

    protected $primaryKey = 'co_cidade';

    public $timestamps = false;

    protected $casts = [
        'co_uf' => 'int',
    ];

    protected $fillable = [
        'no_cidade',
        'co_uf',
    ];
}
