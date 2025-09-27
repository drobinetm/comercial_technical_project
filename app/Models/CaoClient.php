<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoClient
 *
 * @property int $co_cliente
 * @property string|null $no_razao
 * @property string|null $no_fantasia
 * @property string|null $no_contato
 * @property string|null $nu_telefone
 * @property string|null $nu_ramal
 * @property string|null $nu_cnpj
 * @property string|null $ds_endereco
 * @property int|null $nu_numero
 * @property string|null $ds_complemento
 * @property string $no_bairro
 * @property string|null $nu_cep
 * @property string|null $no_pais
 * @property int|null $co_ramo
 * @property int $co_cidade
 * @property int|null $co_status
 * @property string|null $ds_site
 * @property string|null $ds_email
 * @property string|null $ds_cargo_contato
 * @property string|null $tp_cliente
 * @property string|null $ds_referencia
 * @property int|null $co_complemento_status
 * @property string|null $nu_fax
 * @property string|null $ddd2
 * @property string|null $telefone2
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereCoCidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereCoCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereCoComplementoStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereCoRamo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereCoStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereDdd2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereDsCargoContato($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereDsComplemento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereDsEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereDsEndereco($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereDsReferencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereDsSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereNoBairro($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereNoContato($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereNoFantasia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereNoPais($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereNoRazao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereNuCep($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereNuCnpj($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereNuFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereNuNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereNuRamal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereNuTelefone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereTelefone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoClient whereTpCliente($value)
 *
 * @mixin \Eloquent
 */
class CaoClient extends Model
{
    protected $table = 'cao_cliente';

    protected $primaryKey = 'co_cliente';

    public $timestamps = false;

    protected $casts = [
        'nu_numero' => 'int',
        'co_ramo' => 'int',
        'co_cidade' => 'int',
        'co_status' => 'int',
        'co_complemento_status' => 'int',
    ];

    protected $fillable = [
        'no_razao',
        'no_fantasia',
        'no_contato',
        'nu_telefone',
        'nu_ramal',
        'nu_cnpj',
        'ds_endereco',
        'nu_numero',
        'ds_complemento',
        'no_bairro',
        'nu_cep',
        'no_pais',
        'co_ramo',
        'co_cidade',
        'co_status',
        'ds_site',
        'ds_email',
        'ds_cargo_contato',
        'tp_cliente',
        'ds_referencia',
        'co_complemento_status',
        'nu_fax',
        'ddd2',
        'telefone2',
    ];
}
