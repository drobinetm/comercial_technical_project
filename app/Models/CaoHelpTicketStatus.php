<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoHelpTicketStatus
 *
 * @property int $co_status
 * @property string $ds_status
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketStatus whereCoStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoHelpTicketStatus whereDsStatus($value)
 *
 * @mixin \Eloquent
 */
class CaoHelpTicketStatus extends Model
{
    protected $table = 'cao_help_status_chamado';

    protected $primaryKey = 'co_status';

    public $timestamps = false;

    protected $fillable = [
        'ds_status',
    ];
}
