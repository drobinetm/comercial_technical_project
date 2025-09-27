<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoNotice
 *
 * @property int $co_aviso
 * @property string $ds_aviso
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoNotice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoNotice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoNotice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoNotice whereCoAviso($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoNotice whereDsAviso($value)
 *
 * @mixin \Eloquent
 */
class CaoNotice extends Model
{
    protected $table = 'cao_aviso';

    protected $primaryKey = 'co_aviso';

    public $timestamps = false;

    protected $fillable = [
        'ds_aviso',
    ];
}
