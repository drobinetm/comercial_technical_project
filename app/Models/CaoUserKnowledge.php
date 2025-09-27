<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoUserKnowledge
 *
 * @property string $co_usuario
 * @property int $co_conhecimento
 * @property int|null $nv_conhecimento
 * @property int|null $is_certificado
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserKnowledge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserKnowledge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserKnowledge query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserKnowledge whereCoConhecimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserKnowledge whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserKnowledge whereIsCertificado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUserKnowledge whereNvConhecimento($value)
 *
 * @mixin \Eloquent
 */
class CaoUserKnowledge extends Model
{
    protected $table = 'cao_conhecimento_usuario';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'co_conhecimento' => 'int',
        'nv_conhecimento' => 'int',
        'is_certificado' => 'int',
    ];

    protected $fillable = [
        'nv_conhecimento',
        'is_certificado',
    ];
}
