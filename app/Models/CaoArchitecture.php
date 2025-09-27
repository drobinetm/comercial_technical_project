<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoArchitecture
 *
 * @property int $co_arquitetura
 * @property string $ds_arquitetura
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoArchitecture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoArchitecture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoArchitecture query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoArchitecture whereCoArquitetura($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoArchitecture whereDsArquitetura($value)
 *
 * @mixin \Eloquent
 */
class CaoArchitecture extends Model
{
    protected $table = 'cao_arquitetura_os';

    protected $primaryKey = 'co_arquitetura';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'co_arquitetura' => 'int',
    ];

    protected $fillable = [
        'ds_arquitetura',
    ];
}
