<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function maisConsumidos(){
        $data =  DB::select('SELECT 
                            p.id AS id,
                            p.descricao AS descricao,
                            COUNT(osh.produtos_id) AS quantidade
                        FROM
                            ordem_servicos_has_produtos osh
                                INNER JOIN
                            produtos p ON osh.produtos_id = p.id
                        GROUP BY p.id');

        return json_encode($data,JSON_UNESCAPED_UNICODE);
    }
}
