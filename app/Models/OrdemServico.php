<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 08 Apr 2019 00:21:57 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OrdemServico
 * 
 * @property int $id
 * @property string $descricao
 * @property int $cliente_id
 * @property int $user_id
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Cliente $cliente
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $produtos
 *
 * @package App\Models
 */
class OrdemServico extends Eloquent
{
	protected $casts = [
		'cliente_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'descricao',
		'cliente_id',
		'user_id',
		'status',
        'cliente'
	];

	public function cliente()
	{
		return $this->belongsTo(\App\Models\Cliente::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function produtos()
	{
		return $this->belongsToMany(\App\Models\Produto::class, 'ordem_servicos_has_produtos', 'ordem_servicos_id', 'produtos_id')
					->withPivot('valor_venda');
	}
}
