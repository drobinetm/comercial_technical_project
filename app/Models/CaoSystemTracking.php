<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoSystemTracking
 *
 * @property int $co_acompanhamento
 * @property string|null $email
 * @property string|null $senha
 * @property int|null $co_sistema
 * @property string|null $status
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemTracking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemTracking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemTracking query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemTracking whereCoAcompanhamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemTracking whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemTracking whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemTracking whereSenha($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoSystemTracking whereStatus($value)
 *
 * @mixin \Eloquent
 */
class CaoSystemTracking extends Model
{
    protected $table = 'cao_acompanhamento_sistema';

    protected $primaryKey = 'co_acompanhamento';

    public $timestamps = false;

    protected $casts = [
        'co_sistema' => 'int',
    ];

    protected $fillable = [
        'email',
        'senha',
        'co_sistema',
        'status',
    ];
}
