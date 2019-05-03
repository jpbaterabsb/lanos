<?php

/**
 * Created by PhpStorm.
 * User: joaopaulooliveirasantos
 * Date: 2019-04-07
 * Time: 22:43
 */

namespace App\Http\Controllers;


use App\Models\Categoria;
use App\Models\Produto as Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Hash;
class ProdutoController extends Controller {

    public function index()
    {
        $data['Produtos'] = Produto::all();
        return view('Produto/index',$data);
    }
    public function add()
    {
        $data['Categorias'] = Categoria::all();
        return view('Produto/add',$data);
    }
    public function addPost()
    {
        $Produto_data = array(
            'quantidade' => Input::get('quantidade'),
            'valor' => $this->toNumber(Input::get('valor')),
            'categoria_id' => Input::get('categoria'),
            'descricao' => Input::get('descricao'),
        );
        $Produto_id = Produto::insert($Produto_data);
        return redirect('Produto')->with('message', 'Produto successfully added');
    }

    public function toNumber($valor)
    {
       $valor = str_replace(".","",$valor);
       $valor  = str_replace(",",".",$valor);
       return $valor;

    }


    public function delete($id)
    {
        $Produto=Produto::find($id);
        $Produto->delete();
        return redirect('Produto')->with('message', 'Produto deleted successfully.');
    }
    public function edit($id)
    {
        $data['Produto']=Produto::find($id);
        return view('Produto/edit',$data);
    }
    public function editPost()
    {
        $id =Input::get('Produto_id');
        $Produto=Produto::find($id);

        $Produto_data = array(
            'quantidade' => Input::get('quantidade'),
            'valor' => Input::get('valor'),
            'Categoria' => Input::get('Categoria'),
            'descricao' => Input::get('descricao'),
        );
        $Produto_id = Produto::where('id', '=', $id)->update($Produto_data);
        return redirect('Produto')->with('message', 'Produto Updated successfully');
    }


    public function changeStatus($id)
    {
        $Produto=Produto::find($id);
        $Produto->status=!$Produto->status;
        $Produto->save();
        return redirect('Produto')->with('message', 'Change Produto status successfully');
    }
    public function view($id)
    {
        $data['Produto']=Produto::find($id);
        return view('Produto/view',$data);

    }

    public function pesquisarNomeProduto(Request $request)
    {
        $n = $request->query('query');
        $results = array();
        $queries =  DB::table('produtos')
            ->where('descricao', 'like', '%'.$n.'%')
            ->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->descricao, 'valor' => $query->valor ];
        }

        return response()->json(array("suggestions" => $results));
    }

}