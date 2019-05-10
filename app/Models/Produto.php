<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 08 Apr 2019 00:21:57 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Produto
 * 
 * @property int $id
 * @property string $status
 * @property int $quantidade
 * @property float $valor
 * @property int $categoria_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Categoria $categoria
 * @property \Illuminate\Database\Eloquent\Collection $ordem_servicos
 *
 * @package App\Models
 */
class Produto extends Eloquent
{
	protected $casts = [
		'quantidade' => 'int',
		'valor' => 'float',
		'categoria_id' => 'int'
	];

	protected $fillable = [
		'status',
		'quantidade',
        'descricao',
		'valor',
		'categoria_id',
        'status'
	];

	public function categoria()
	{
		return $this->belongsTo(\App\Models\Categoria::class);
	}

	public function ordem_servicos()
	{
		return $this->belongsToMany(\App\Models\OrdemServico::class, 'ordem_servicos_has_produtos', 'produtos_id', 'ordem_servicos_id')
					->withPivot('quantidade');
	}
}
