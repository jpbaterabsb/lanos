<?php

/**
 * Created by PhpStorm.
 * User: joaopaulooliveirasantos
 * Date: 2019-04-08
 * Time: 00:07
 */

namespace App\Http\Controllers;

use App\Models\Cliente as Cliente;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Hash;
class ClienteController extends Controller {

    public function index()
    {
        $data['Clientes'] = Cliente::all();
        return view('Cliente/index',$data);
    }
    public function add()
    {
        return view('Cliente/add');
    }
    public function addPost()
    {
        $Cliente_data = array(
            'nome' => Input::get('nome'),
            'cpf' => Input::get('cpf'),
            'email' => Input::get('email'),
            'telefone' => Input::get('telefone'),
            'endereco' => Input::get('endereco'),
        );
        $Cliente_id = Cliente::insert($Cliente_data);
        return redirect('Cliente')->with('message', 'Cliente successfully added');
    }
    public function delete($id)
    {
        $Cliente=Cliente::find($id);
        $Cliente->delete();
        return redirect('Cliente')->with('message', 'Cliente deleted successfully.');
    }
    public function edit($id)
    {
        $data['Cliente']=Cliente::find($id);
        return view('Cliente/edit',$data);
    }
    public function editPost()
    {
        $id =Input::get('Cliente_id');
        $Cliente=Cliente::find($id);

        $Cliente_data = array(
            'nome' => Input::get('nome'),
            'cpf' => Input::get('cpf'),
            'email' => Input::get('email'),
            'telefone' => Input::get('telefone'),
            'endereco' => Input::get('endereco'),
        );
        $Cliente_id = Cliente::where('id', '=', $id)->update($Cliente_data);
        return redirect('Cliente')->with('message', 'Cliente Updated successfully');
    }


    public function changeStatus($id)
    {
        $Cliente=Cliente::find($id);
        $Cliente->status=!$Cliente->status;
        $Cliente->save();
        return redirect('Cliente')->with('message', 'Change Cliente status successfully');
    }
    public function view($id)
    {
        $data['Cliente']=Cliente::find($id);
        return view('Cliente/view',$data);

    }
}