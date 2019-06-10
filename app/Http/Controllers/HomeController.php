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
       $data['faturamentoDiario'] = DB::select('SELECT os.id, sum(oshp.valor_venda) as valor FROM lanos.ordem_servicos os
                                inner join lanos.ordem_servicos_has_produtos oshp on oshp.ordem_servicos_id = os.id
                                where os.created_at > timestamp(current_date)
                                group by os.id');

        $date = new \DateTime('now');
        $diaDeHoje = $date->format('d');
        $data['diaDeHoje'] = $diaDeHoje;
        $date->modify('last day of this month');
        $ultimoDiaDoMes = $date->format('d');
        $data['ultimoDiaDoMes'] = $ultimoDiaDoMes;
        $data['porcentagemDoDiaDoMes'] = ObjectHelper::porcentage($diaDeHoje,$ultimoDiaDoMes);


        $valorTotalOf = 'SELECT os.id, sum(oshp.valor_venda) as valor FROM lanos.ordem_servicos os
                                inner join lanos.ordem_servicos_has_produtos oshp on oshp.ordem_servicos_id = os.id ';
        $periodoDia = ' where os.created_at > timestamp(current_date)';
        $periodoMensal = " where (os.created_at between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )";
        $groupByIdOs = ' group by os.id';

        $data['faturamentoDiaro'] = DB::select($valorTotalOf
                                                    .$periodoDia
                                                    .$groupByIdOs);

        $data['faturamentoMensal'] = DB::select($valorTotalOf
                                                        .$periodoMensal
                                                        . $groupByIdOs);

        $data['ordemDeServicoAberto'] = OrdemServico::query()->where('status','0')->count();

        return view('home', $data);
    }
}
