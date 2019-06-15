<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $casts = [
        'cliente_id' => 'int',
    ];

    protected $fillable = [
        'cep','logradouro','complemento','bairro','localidade','uf','cliente_id'
    ];

    public function cliente()
    {
        return $this->hasOne(\App\Models\Cliente::class, 'cliente_id');
    }

    protected $table = 'endereco';
}
