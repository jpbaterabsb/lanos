<?php

/**
 * Created by PhpStorm.
 * User: joaopaulooliveirasantos
 * Date: 2019-04-08
 * Time: 00:07
 */

namespace App\Http\Controllers;

use App\Helper\ObjectHelper;
use App\Models\Cliente as Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Hash;
class ClienteController extends Controller {

    public function index()
    {
        $data['Clientes'] = Cliente::query()->where('status','1')->get();
        return view('Cliente/index',$data);
    }
    public function add()
    {
        return view('Cliente/add');
    }
    public function addPost(Request $request)
    {

        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|unique:clientes,cpf|min:14',
            'telefone' => 'min:14',
            'email' => 'required',
            'endereco' => 'required',
        ]);

        $Cliente_data = array(
            'nome' => Input::get('nome'),
            'cpf' => Input::get('cpf'),
            'email' => Input::get('email'),
            'telefone' => Input::get('telefone'),
            'endereco' => Input::get('endereco'),
            'status' => 1
        );
        Cliente::insert($Cliente_data);
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
        $Cliente->status= !$Cliente->status;
        $Cliente->save();
        return redirect('Cliente')->with('message', 'Change Cliente status successfully');
    }
    public function view($id)
    {
        $data['Cliente']=Cliente::find($id);
        return view('Cliente/view',$data);

    }

    public function filter(Request $request)
    {
        $cliente = Cliente::query();
       if (!ObjectHelper::IsNullOrEmptyString($request->nome)){
            $cliente->where('nome','like','%'.$request->nome.'%');
       }
        if (!ObjectHelper::IsNullOrEmptyString($request->telefone)){
            $cliente->where('telefone','like','%'.$request->telefone.'%');
        }
        if (!ObjectHelper::IsNullOrEmptyString($request->email)){
            $cliente->where('email','=',$request->email);
        }
        if (!ObjectHelper::IsNullOrEmptyString($request->cpf)){
            $cliente->where('cpf','=',$request->cpf);
        }
        if (!ObjectHelper::IsNullOrEmptyString($request->endereco)){
            $cliente->where('endereco','like','%'.$request->cpf.'%');
        }

        $cliente = ObjectHelper::getQueryStatus($cliente,$request->status);

        $data['Clientes'] = $cliente->get();
        return view('Cliente/index',$data);
    }
}