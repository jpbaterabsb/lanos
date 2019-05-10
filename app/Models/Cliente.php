<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 08 Apr 2019 00:21:57 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Cliente
 * 
 * @property int $id
 * @property string $cpf
 * @property string $nome
 * @property string $telefone
 * @property string $email
 * @property string $endereco
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $ordem_servicos
 *
 * @package App\Models
 */
class Cliente extends Eloquent
{
	protected $fillable = [
		'cpf',
		'nome',
		'telefone',
		'email',
		'endereco',
		'status'
	];

	public function ordem_servicos()
	{
		return $this->hasMany(\App\Models\OrdemServico::class);
	}
}