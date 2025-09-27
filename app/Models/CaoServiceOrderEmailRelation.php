<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoServiceOrderEmailRelation
 *
 * @property int $id
 * @property int $co_email
 * @property int $co_os
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmailRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmailRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmailRelation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmailRelation whereCoEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmailRelation whereCoOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmailRelation whereId($value)
 *
 * @mixin \Eloquent
 */
class CaoServiceOrderEmailRelation extends Model
{
    protected $table = 'cao_rel_email_os';

    public $timestamps = false;

    protected $casts = [
        'co_email' => 'int',
        'co_os' => 'int',
    ];

    protected $fillable = [
        'co_email',
        'co_os',
    ];
}
