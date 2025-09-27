<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoHelpTicketScreen
 *
 * @property int $co_tela
 * @property int $co_cliente
 * @property int $co_sistema
 * @property string $ds_tela
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketScreen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketScreen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketScreen query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketScreen whereCoCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketScreen whereCoSistema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketScreen whereCoTela($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketScreen whereDsTela($value)
 *
 * @mixin \Eloquent
 */
class CaoHelpTicketScreen extends Model
{
    protected $table = 'cao_help_tela_chamado';

    protected $primaryKey = 'co_tela';

    public $timestamps = false;

    protected $casts = [
        'co_cliente' => 'int',
        'co_sistema' => 'int',
    ];

    protected $fillable = [
        'co_cliente',
        'co_sistema',
        'ds_tela',
    ];
}
