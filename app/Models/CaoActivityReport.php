<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoActivityReport
 *
 * @property int $id
 * @property int $co_cliente
 * @property string|null $inicio
 * @property string|null $fim
 * @property string|null $lembrete
 * @property int $co_atividade
 * @property int $co_os
 * @property string|null $assunto
 * @property string|null $conteudo
 * @property string $status
 * @property string|null $tempo
 * @property string $co_usuario
 * @property Carbon $data_ativ
 * @property string $retorno
 * @property int|null $co_fase
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereAssunto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereCoAtividade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereCoCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereCoFase($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereCoOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereConteudo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereDataAtiv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereFim($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereLembrete($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereRetorno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoActivityReport whereTempo($value)
 *
 * @mixin \Eloquent
 */
class CaoActivityReport extends Model
{
    protected $table = 'cao_atividade_report';

    public $timestamps = false;

    protected $casts = [
        'co_cliente' => 'int',
        'co_atividade' => 'int',
        'co_os' => 'int',
        'data_ativ' => 'datetime',
        'co_fase' => 'int',
    ];

    protected $fillable = [
        'co_cliente',
        'inicio',
        'fim',
        'lembrete',
        'co_atividade',
        'co_os',
        'assunto',
        'conteudo',
        'status',
        'tempo',
        'co_usuario',
        'data_ativ',
        'retorno',
        'co_fase',
    ];
}
