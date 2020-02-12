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
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Hash;
use File;

class ClienteController extends Controller {

    public function index()
    {
        $data['Clientes'] = Cliente::query()->where('status','1')->get();
        return view('cliente/index',$data);
    }
    public function add()
    {

        return view('cliente/add');
    }
    public function addPost(Request $request)
    {

        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|unique:clientes,cpf|min:14',
            'telefone' => 'min:14',
            'email' => 'required',
            'cep' => 'min:10'
        ]);

        $cliente = new Cliente;

        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->email = $request->email;
        $cliente->telefone = $request->telefone;
        $cliente->status = 1;
        $endereco = new Endereco();
        $endereco->cep = $request->cep;
        $endereco->logradouro = $request->logradouro;
        $endereco->complemento = $request->complemento;
        $endereco->localidade = $request->localidade;
        $endereco->bairro = $request->bairro;
        $endereco->uf = $request->uf;

        DB::transaction(function () use($cliente,$endereco){
            $cliente->save();
            $cliente->endereco()->save($endereco);
        });


        return redirect('cliente')->with('message', 'cliente successfully added');
    }
    public function delete($id)
    {
        $Cliente=Cliente::find($id);
        $Cliente->delete();
        return redirect('cliente')->with('message', 'cliente deleted successfully.');
    }
    public function edit($id)
    {
        $data['cliente']=Cliente::find($id);
        return view('cliente/edit',$data);
    }
    public function editPost(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|min:14',
            'telefone' => 'min:14',
            'email' => 'required',
            'cep' => 'min:10'
        ]);

        $id =Input::get('Cliente_id');
        $cliente = Cliente::find($id);

        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->email = $request->email;
        $cliente->telefone = $request->telefone;

        $cliente->endereco->cep = $request->cep;
        $cliente->endereco->logradouro = $request->logradouro;
        $cliente->endereco->complemento = $request->complemento;
        $cliente->endereco->localidade = $request->localidade;
        $cliente->endereco->bairro = $request->bairro;
        $cliente->endereco->uf = $request->uf;

        $cliente->push();

        return redirect('cliente')->with('message', 'cliente successfully added');
    }


    public function changeStatus($id)
    {
        $Cliente=Cliente::find($id);
        $Cliente->status= !$Cliente->status;
        $Cliente->save();
        return redirect('cliente')->with('message', 'Change cliente status successfully');
    }
    public function view($id)
    {
        $data['cliente']=Cliente::find($id);
        return view('cliente/view',$data);

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
        return view('cliente/index',$data);
    }
}
