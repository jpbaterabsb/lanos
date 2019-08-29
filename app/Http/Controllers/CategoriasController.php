<?php

/**
 * Created by PhpStorm.
 * User: joaopaulooliveirasantos
 * Date: 2019-04-07
 * Time: 22:18
 */

namespace App\Http\Controllers;

use App\Models\Categoria as Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Hash;
class CategoriasController extends Controller {

    public function index()
    {
        $data['Categoriass'] = Categoria::query()->where('status','1')->get();
        return view('categorias/index',$data);
    }
    public function add()
    {
        return view('categorias/add');
    }
    public function addPost(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:3|max:50',
        ]);

        $Categorias_data = array(
            'nome' => Input::get('nome'),
            'status' => true
        );
        $Categorias_id = Categoria::insert($Categorias_data);
        return redirect('categorias')->with('message', 'Categorias successfully added');
    }
    public function delete($id)
    {
        $Categorias=Categoria::find($id);
        $Categorias->delete();
        return redirect('categorias')->with('message', 'Categorias deleted successfully.');
    }
    public function edit($id)
    {
        $data['Categorias']=Categoria::find($id);
        return view('categorias/edit',$data);
    }
    public function editPost()
    {
        $id =Input::get('Categorias_id');
        $Categorias=Categoria::find($id);

        $Categorias_data = array(
            'nome' => Input::get('nome'),
        );
        $Categorias_id = Categoria::where('id', '=', $id)->update($Categorias_data);
        return redirect('categorias')->with('message', 'Categorias Updated successfully');
    }


    public function changeStatus($id)
    {
        $Categorias=Categoria::find($id);
        $Categorias->status=!$Categorias->status;
        $Categorias->save();
        return redirect('categorias')->with('message', 'Change Categorias status successfully');
    }
    public function view($id)
    {
        $data['Categorias']=Categoria::find($id);
        return view('categorias/view',$data);

    }
}