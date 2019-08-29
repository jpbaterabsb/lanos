<?php

namespace App\Http\Controllers;

use App\Helper\ObjectHelper;
use App\Models\OrdemServico;
use App\Models\OrdemServicosHasProduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data =array();

        $date = new \DateTime('now');
        $diaDeHoje = $date->format('d');
        $data['diaDeHoje'] = $diaDeHoje;
        $date->modify('last day of this month');
        $ultimoDiaDoMes = $date->format('d');
        $data['ultimoDiaDoMes'] = $ultimoDiaDoMes;
        $data['porcentagemDoDiaDoMes'] = ObjectHelper::porcentage($diaDeHoje,$ultimoDiaDoMes);


        $valorTotalOf = 'SELECT os.id, sum(oshp.valor_venda) as valor FROM ordem_servicos os
                                inner join ordem_servicos_has_produtos oshp on oshp.ordem_servicos_id = os.id ';
        $periodoDia = ' where os.created_at > timestamp(current_date)';
        $periodoMensal = " where (os.created_at between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )";
        $groupByIdOs = ' group by os.id';

        $date = date("Y-m-d 00:00:00");


        $data['faturamentoDiario'] = DB::select("SELECT sum(oshp.valor_venda) as valor FROM ordem_servicos os
                                inner join ordem_servicos_has_produtos oshp on oshp.ordem_servicos_id = os.id
                                where os.created_at > '". $date."'");

        $data['faturamentoMensal'] = DB::select("SELECT sum(oshp.valor_venda) as valor FROM ordem_servicos os
                                inner join ordem_servicos_has_produtos oshp on oshp.ordem_servicos_id = os.id
                                where (os.created_at between  ? AND ? )",[date("Y-m-01 00:00:00"),date("Y-m-d H:m:s")]);

        $data['ordemDeServicoAberto'] = OrdemServico::query()->where('status','0')->count();

        return view('home', $data);
    }
}
