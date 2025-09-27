<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoTicket
 *
 * @property int $co_boleto
 * @property int $co_cliente
 * @property int $co_sistema
 * @property int $co_os
 * @property string $valor
 * @property string $vencimento
 * @property int $status
 * @property string|null $boleto
 * @property string|null $linha_dig
 * @property string|null $parcela
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicket query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicket whereBoleto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicket whereCoBoleto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicket whereCoCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicket whereCoOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicket whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicket whereLinhaDig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicket whereParcela($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicket whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicket whereValor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoTicket whereVencimento($value)
 *
 * @mixin \Eloquent
 */
class CaoTicket extends Model
{
    protected $table = 'cao_boleto';

    protected $primaryKey = 'co_boleto';

    public $timestamps = false;

    protected $casts = [
        'co_cliente' => 'int',
        'co_sistema' => 'int',
        'co_os' => 'int',
        'status' => 'int',
    ];

    protected $fillable = [
        'co_cliente',
        'co_sistema',
        'co_os',
        'valor',
        'vencimento',
        'status',
        'boleto',
        'linha_dig',
        'parcela',
    ];
}
