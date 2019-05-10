<?php

/**
 * Created by PhpStorm.
 * User: joaopaulooliveirasantos
 * Date: 2019-04-07
 * Time: 22:18
 */

namespace App\Http\Controllers;

use App\Models\Categoria as Categoria;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Hash;
class CategoriasController extends Controller {

    public function index()
    {
        $data['Categoriass'] = Categoria::query()->where('status','1')->get();
        return view('Categorias/index',$data);
    }
    public function add()
    {
        return view('Categorias/add');
    }
    public function addPost()
    {
        $Categorias_data = array(
            'nome' => Input::get('nome'),
            'status' => true
        );
        $Categorias_id = Categoria::insert($Categorias_data);
        return redirect('Categorias')->with('message', 'Categorias successfully added');
    }
    public function delete($id)
    {
        $Categorias=Categoria::find($id);
        $Categorias->delete();
        return redirect('Categorias')->with('message', 'Categorias deleted successfully.');
    }
    public function edit($id)
    {
        $data['Categorias']=Categoria::find($id);
        return view('Categorias/edit',$data);
    }
    public function editPost()
    {
        $id =Input::get('Categorias_id');
        $Categorias=Categoria::find($id);

        $Categorias_data = array(
            'nome' => Input::get('nome'),
        );
        $Categorias_id = Categoria::where('id', '=', $id)->update($Categorias_data);
        return redirect('Categorias')->with('message', 'Categorias Updated successfully');
    }


    public function changeStatus($id)
    {
        $Categorias=Categoria::find($id);
        $Categorias->status=!$Categorias->status;
        $Categorias->save();
        return redirect('Categorias')->with('message', 'Change Categorias status successfully');
    }
    public function view($id)
    {
        $data['Categorias']=Categoria::find($id);
        return view('Categorias/view',$data);

    }
}