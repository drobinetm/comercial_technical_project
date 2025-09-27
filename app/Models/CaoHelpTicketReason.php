<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoHelpTicketReason
 *
 * @property int $co_motivo
 * @property string $ds_motivo
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketReason query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketReason whereCoMotivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketReason whereDsMotivo($value)
 *
 * @mixin \Eloquent
 */
class CaoHelpTicketReason extends Model
{
    protected $table = 'cao_help_motivo_chamado';

    protected $primaryKey = 'co_motivo';

    public $timestamps = false;

    protected $fillable = [
        'ds_motivo',
    ];
}
