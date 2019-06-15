<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefones extends Model
{

    protected $casts = [
        'cliente_id' => 'int',
    ];

    protected $fillable = [
        'id','cliente_id','telefone','tipo'
    ];

    public function cliente()
    {
        return $this->belongsTo(\App\Models\Cliente::class, 'cliente_id');
    }
}
