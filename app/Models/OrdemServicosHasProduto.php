<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 08 Apr 2019 00:21:57 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OrdemServicosHasProduto
 * 
 * @property int $ordem_servicos_id
 * @property int $produtos_id
 * @property int $quantidade
 * 
 * @property \App\Models\OrdemServico $ordem_servico
 * @property \App\Models\Produto $produto
 *
 * @package App\Models
 */
class OrdemServicosHasProduto extends Eloquent
{
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'ordem_servicos_id' => 'int',
		'produtos_id' => 'int',
		'quantidade' => 'int',
        'id' => 'int'
	];

	protected $fillable = [
		'ordem_servicos_id',
		'produtos_id',
		'valor_venda',
        'data',
        'id'
	];

	public function ordem_servico()
	{
		return $this->belongsTo(\App\Models\OrdemServico::class, 'ordem_servicos_id');
	}

	public function produto()
	{
		return $this->belongsTo(\App\Models\Produto::class, 'produtos_id');
	}
}
