<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoOffice
 *
 * @property int $co_escritorio
 * @property string $local
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOffice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOffice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOffice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOffice whereCoEscritorio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOffice whereLocal($value)
 *
 * @mixin \Eloquent
 */
class CaoOffice extends Model
{
    protected $table = 'cao_escritorio';

    protected $primaryKey = 'co_escritorio';

    public $timestamps = false;

    protected $fillable = [
        'local',
    ];
}
