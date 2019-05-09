<?php

/**
 * Created by PhpStorm.
 * User: joaopaulooliveirasantos
 * Date: 2019-04-07
 * Time: 23:56
 */

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\OrdemServico as OrdemServico;
use App\Models\OrdemServicosHasProduto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Hash;
class OrdemServicoController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['OrdemServicos'] = OrdemServico::all();
        return view('OrdemServico/index',$data);
    }
    public function add()
    {
        $data['clientes'] = Cliente::all();
        return view('OrdemServico/add',$data);
    }
    public function addPost(Request $request)
    {
        $validatedData = $request->validate([
            'descricao' => 'required|unique:posts|max:255'
        ]);


        $produtos = json_decode(Input::get('listaProduto'));

        $OrdemServico_data = array(
            'descricao' => Input::get('descricao'),
            'cliente_id' => Input::get('cliente'),
            'user_id'=> Auth::user()->getAuthIdentifier(),
            'created_at' => Carbon::now(),
        );

        $OrdemServico_id = OrdemServico::create($OrdemServico_data);

        foreach ($produtos as $produto){
            $ordemServicosProduto = array(
                'ordem_servicos_id' => $OrdemServico_id->id,
                'produtos_id' => $produto->id,
                'valor_venda' => $produto->valor,
                'data' => Carbon::now()
            );
            OrdemServicosHasProduto::create($ordemServicosProduto);
        }

        return redirect('OrdemServico')->with('message', 'OrdemServico successfully added');
    }
    public function delete($id)
    {
        $OrdemServico=OrdemServico::find($id);
        $OrdemServico->delete();
        return redirect('OrdemServico')->with('message', 'OrdemServico deleted successfully.');
    }
    public function edit($id)
    {
        $ordemServico = OrdemServico::find($id);
        $data['OrdemServico']=$ordemServico;
        $data['OrdemServico']['cliente']=$ordemServico->cliente;
        $data['clientes'] = Cliente::all();
        $data['listaProduto'] = json_encode(DB::select('
        SELECT 
            op.id as opid,
            p.id as pid,
            p.descricao,
            op.valor_venda
        FROM
            ordem_servicos o
                INNER JOIN
            ordem_servicos_has_produtos op ON o.id = op.ordem_servicos_id
                INNER JOIN
            produtos p on p.id = op.produtos_id where o.id = ?;
        ',[$id]));
        return view('OrdemServico/edit',$data);
    }

    public function editPost(Request $request)
    {

        $listaProduto = json_decode($request->listaProduto);
        $opid = [];
        foreach ($listaProduto as $produto){

            if ($this->IsNullOrEmptyString($produto->opid)){
               $os = OrdemServicosHasProduto::create([
                    'ordem_servicos_id' => $request->OrdemServico_id,
                    'produtos_id' => $produto->id,
                    'valor_venda' => $produto->valor
                ]);
                array_push($opid,$os->id);
            }else{

                $ordemServicoHasProduto = OrdemServicosHasProduto::find($produto->opid);

                $ordemServicoHasProduto->valor_venda = $produto->valor;

                $ordemServicoHasProduto->save();

                array_push($opid,$produto->opid);

            }


        }

        DB::table('ordem_servicos_has_produtos')
            ->where('ordem_servicos_id',$request->OrdemServico_id)
            ->whereNotIn('id',$opid)
            ->delete();

//        DB::delete("delete from   where  ordem_servicos_id = ? and id not in(?)",[$request->OrdemServico_id,$opid]);

        $OrdemServico=OrdemServico::find($request->OrdemServico_id);

        $OrdemServico_data = array(
            'descricao' => $request->descricao,
            'cliente_id' => $request->cliente,
            'updated_at' => Carbon::now()
        );
        $OrdemServico_id = OrdemServico::where('id', '=', $request->OrdemServico_id)->update($OrdemServico_data);
        return redirect('OrdemServico')->with('message', 'OrdemServico Updated successfully');
    }


    function IsNullOrEmptyString($str){
        return (!isset($str) || trim($str) === '');
    }

    public function changeStatus($id)
    {
        $OrdemServico=OrdemServico::find($id);
        $OrdemServico->status=!$OrdemServico->status;
        $OrdemServico->save();
        return redirect('OrdemServico')->with('message', 'Change OrdemServico status successfully');
    }
    public function view($id)
    {
        $data['OrdemServico']=OrdemServico::find($id);
        return view('OrdemServico/view',$data);

    }
}