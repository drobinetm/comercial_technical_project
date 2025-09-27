<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoState
 *
 * @property int $co_uf
 * @property string $ds_uf
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoState newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoState newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoState query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoState whereCoUf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoState whereDsUf($value)
 *
 * @mixin \Eloquent
 */
class CaoState extends Model
{
    protected $table = 'cao_uf';

    protected $primaryKey = 'co_uf';

    public $timestamps = false;

    protected $fillable = [
        'ds_uf',
    ];
}
