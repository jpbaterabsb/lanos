<?php

/**
 * Created by PhpStorm.
 * User: joaopaulooliveirasantos
 * Date: 2019-04-07
 * Time: 22:52
 */

namespace App\Http\Controllers;

use App\User as User;
use Illuminate\Support\Facades\Input;
use Hash;
class UserController extends Controller {

    public function index()
    {
        $data['Users'] = User::all();
        return view('User/index',$data);
    }
    public function add()
    {
        return view('User/add');
    }
    public function addPost()
    {
        $User_data = array(
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password')),
        );
        $User_id = User::insert($User_data);
        return redirect('User')->with('message', 'User successfully added');
    }
    public function delete($id)
    {
        $User=User::find($id);
        $User->delete();
        return redirect('User')->with('message', 'User deleted successfully.');
    }
    public function edit($id)
    {
        $data['User']=User::find($id);
        return view('User/edit',$data);
    }
    public function editPost()
    {
        $id =Input::get('User_id');
        $User=User::find($id);

        $User_data = array(
            'name' => Input::get('name'),
            'email' => Input::get('email'),
        );
        $User_id = User::where('id', '=', $id)->update($User_data);
        return redirect('User')->with('message', 'User Updated successfully');
    }


    public function changeStatus($id)
    {
        $User=User::find($id);
        $User->status=!$User->status;
        $User->save();
        return redirect('User')->with('message', 'Change User status successfully');
    }
    public function view($id)
    {
        $data['User']=User::find($id);
        return view('User/view',$data);

    }
}