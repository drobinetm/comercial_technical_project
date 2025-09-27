<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoServiceOrderEmail
 *
 * @property int $co_email
 * @property int|null $co_os
 * @property string|null $email
 * @property string|null $senha
 * @property string $nome
 * @property int $co_cliente
 * @property int $ativo
 * @property string|null $ddd
 * @property string|null $tel
 * @property string|null $cargo
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmail query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmail whereAtivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmail whereCargo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmail whereCoCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmail whereCoEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmail whereCoOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmail whereDdd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmail whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmail whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmail whereSenha($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoServiceOrderEmail whereTel($value)
 *
 * @mixin \Eloquent
 */
class CaoServiceOrderEmail extends Model
{
    protected $table = 'cao_os_email';

    protected $primaryKey = 'co_email';

    public $timestamps = false;

    protected $casts = [
        'co_os' => 'int',
        'co_cliente' => 'int',
        'ativo' => 'int',
    ];

    protected $fillable = [
        'co_os',
        'email',
        'senha',
        'nome',
        'co_cliente',
        'ativo',
        'ddd',
        'tel',
        'cargo',
    ];
}
