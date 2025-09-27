<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class CaoUser
 *
 * @property string $co_usuario
 * @property string $no_usuario
 * @property string $ds_senha
 * @property string|null $co_usuario_autorizacao
 * @property int|null $nu_matricula
 * @property Carbon|null $dt_nascimento
 * @property Carbon|null $dt_admissao_empresa
 * @property Carbon|null $dt_desligamento
 * @property Carbon|null $dt_inclusao
 * @property Carbon|null $dt_expiracao
 * @property string|null $nu_cpf
 * @property string|null $nu_rg
 * @property string|null $no_orgao_emissor
 * @property string|null $uf_orgao_emissor
 * @property string|null $ds_endereco
 * @property string|null $no_email
 * @property string|null $no_email_pessoal
 * @property string|null $nu_telefone
 * @property Carbon $dt_alteracao
 * @property string|null $url_foto
 * @property string|null $instant_messenger
 * @property int|null $icq
 * @property string|null $msn
 * @property string|null $yms
 * @property string|null $ds_comp_end
 * @property string|null $ds_bairro
 * @property string|null $nu_cep
 * @property string|null $no_cidade
 * @property string|null $uf_cidade
 * @property Carbon|null $dt_expedicao
 * @property Collection|CaoKnowledge[] $cao_knowledges
 * @property Collection|CaoServiceOrderHistory[] $cao_service_order_histories
 * @property CaoPermission|null $cao_permission
 * @property Collection|CaoKnowledgePoints[] $cao_knowledge_points
 * @property Collection|CaoSalaryPayment[] $cao_salary_payments
 * @property-read int|null $cao_knowledge_points_count
 * @property-read int|null $cao_knowledges_count
 * @property-read int|null $cao_salary_payments_count
 * @property-read int|null $cao_service_order_histories_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereCoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereCoUsuarioAutorizacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereDsBairro($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereDsCompEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereDsEndereco($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereDsSenha($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereDtAdmissaoEmpresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereDtAlteracao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereDtDesligamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereDtExpedicao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereDtExpiracao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereDtInclusao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereDtNascimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereIcq($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereInstantMessenger($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereMsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereNoCidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereNoEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereNoEmailPessoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereNoOrgaoEmissor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereNoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereNuCep($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereNuCpf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereNuMatricula($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereNuRg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereNuTelefone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereUfCidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereUfOrgaoEmissor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereUrlFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CaoUser whereYms($value)
 *
 * @mixin \Eloquent
 */
class CaoUser extends Model
{
    protected $table = 'cao_usuario';

    protected $primaryKey = 'co_usuario';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'nu_matricula' => 'int',
        'dt_nascimento' => 'datetime',
        'dt_admissao_empresa' => 'datetime',
        'dt_desligamento' => 'datetime',
        'dt_inclusao' => 'datetime',
        'dt_expiracao' => 'datetime',
        'dt_alteracao' => 'datetime',
        'icq' => 'int',
        'dt_expedicao' => 'datetime',
    ];

    protected $fillable = [
        'no_usuario',
        'ds_senha',
        'co_usuario_autorizacao',
        'nu_matricula',
        'dt_nascimento',
        'dt_admissao_empresa',
        'dt_desligamento',
        'dt_inclusao',
        'dt_expiracao',
        'nu_cpf',
        'nu_rg',
        'no_orgao_emissor',
        'uf_orgao_emissor',
        'ds_endereco',
        'no_email',
        'no_email_pessoal',
        'nu_telefone',
        'dt_alteracao',
        'url_foto',
        'instant_messenger',
        'icq',
        'msn',
        'yms',
        'ds_comp_end',
        'ds_bairro',
        'nu_cep',
        'no_cidade',
        'uf_cidade',
        'dt_expedicao',
    ];

    public function cao_knowledges(): HasMany
    {
        return $this->hasMany(CaoKnowledge::class, 'usuario');
    }

    public function cao_service_order_histories(): HasMany
    {
        return $this->hasMany(CaoServiceOrderHistory::class, 'co_usuario');
    }

    public function cao_permission(): HasOne
    {
        return $this->hasOne(CaoPermission::class, 'co_usuario');
    }

    public function cao_knowledge_points(): HasMany
    {
        return $this->hasMany(CaoKnowledgePoints::class, 'co_coordenador');
    }

    public function cao_salary_payments(): HasMany
    {
        return $this->hasMany(CaoSalaryPayment::class, 'co_usuario');
    }
}
