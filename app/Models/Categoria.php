<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 08 Apr 2019 00:21:57 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Categoria
 * 
 * @property int $id
 * @property string $nome
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $produtos
 *
 * @package App\Models
 */
class Categoria extends Eloquent
{
	protected $fillable = [
		'nome',
		'status'
	];

	public function produtos()
	{
		return $this->hasMany(\App\Models\Produto::class);
	}
}
