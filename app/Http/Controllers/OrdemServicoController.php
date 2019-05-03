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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Hash;
class OrdemServicoController extends Controller {

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
    public function addPost()
    {
        $OrdemServico_data = array(
            'descricao' => Input::get('descricao'),
            'cliente' => Input::get('cliente'),
            'produto' => Input::get('produto'),
        );
        $OrdemServico_id = OrdemServico::insert($OrdemServico_data);
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
        $data['OrdemServico']=OrdemServico::find($id);
        return view('OrdemServico/edit',$data);
    }
    public function editPost()
    {
        $id =Input::get('OrdemServico_id');
        $OrdemServico=OrdemServico::find($id);

        $OrdemServico_data = array(
            'descricao' => Input::get('descricao'),
            'cliente' => Input::get('cliente'),
            'produto' => Input::get('produto'),
        );
        $OrdemServico_id = OrdemServico::where('id', '=', $id)->update($OrdemServico_data);
        return redirect('OrdemServico')->with('message', 'OrdemServico Updated successfully');
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