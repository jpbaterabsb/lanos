<?php

/**
 * Created by PhpStorm.
 * User: joaopaulooliveirasantos
 * Date: 2019-04-07
 * Time: 22:52
 */

namespace App\Http\Controllers;

use App\Helper\ObjectHelper;
use App\User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{

    public function index()
    {
        $data['Users'] = User::all();
        return view('user/index', $data);
    }

    public function add()
    {
        return view('user/add');
    }

    public function addPost(Request $request)
    {

        $request->validate([
            'name' => 'required|min:5|max:50',
            'email' => 'required|min:5|max:50|unique:users,email',
            'nivel' => 'required',
            'password' => 'required',
            'confirmationPassword' => 'required',
        ]);

        if ($request->password !== $request->confirmationPassword) {
            return back()->withErrors('Senhas diferentes')->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nivel = $request->nivel;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('user')->with('message', 'User successfully added');
    }

    public function delete($id)
    {
        $User = User::find($id);
        $User->delete();
        return redirect('user')->with('message', 'User deleted successfully.');
    }

    public function edit($id)
    {
        $data['User'] = User::find($id);
        $data['habilitado'] = false;
        return view('user/edit', $data);
    }

    public function editPost(Request $request)
    {
        $id = $request->User_id;

        if (ObjectHelper::isOwner($id)) {
            $hasAlteracaoSenha = (bool)Input::get('hasAlteracaoSenha');
            $User = User::find($id);

            $User_data = array(
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'nivel' => Input::get('nivel')
            );

            if ($hasAlteracaoSenha) {

                $request->validate([
                    'old-password' => 'required',
                    'new-password' => 'required',
                    'confirm-password' => 'required'
                ]);

                $oldPassword = Input::get('old-password');
                $newPassword = Input::get('new-password');
                $confirmPassword = Input::get('confirm-password');

                if (Hash::check($oldPassword, $User->password) && $newPassword == $confirmPassword) {
                    $User_data['password'] = Hash::make($newPassword);
                } else {
                    return back()->withErrors('Senha nao corresponde com a senha antiga.');
                }

            }
            User::where('id', '=', $id)->update($User_data);
        } else {

            $request->validate([
                'nivel' => 'required|in:USER,ADMIN'
            ]);
            $user = User::find($id);
            $user->nivel = $request->nivel;
            $user->save();
        }
        return redirect('user')->with('message', 'User Updated successfully');
    }


    public function changeStatus($id)
    {
        $User = User::find($id);
        $User->status = !$User->status;
        $User->save();
        return redirect('user')->with('message', 'Change User status successfully');
    }

    public function view($id)
    {
        $data['User'] = User::find($id);
        return view('user/view', $data);

    }

    public function profile()
    {
        $id = Auth::user()->getAuthIdentifier();
        $data['User'] = User::query()->where('id', $id)->first();
        return view('user.edit', $data);
    }
}
