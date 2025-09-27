<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoOvertimePermission
 *
 * @property int $id_permissao
 * @property int $co_movimento
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOvertimePermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOvertimePermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOvertimePermission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOvertimePermission whereCoMovimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoOvertimePermission whereIdPermissao($value)
 *
 * @mixin \Eloquent
 */
class CaoOvertimePermission extends Model
{
    protected $table = 'cao_permissao_hora_extra';

    protected $primaryKey = 'id_permissao';

    public $timestamps = false;

    protected $casts = [
        'co_movimento' => 'int',
    ];

    protected $fillable = [
        'co_movimento',
    ];
}
