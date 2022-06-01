<?php

namespace Modules\UserModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Modules\UserModule\Entities\User;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function setUserAccount(Request $request)
    {
        $request->validate([
            'username'=>"required|string|unique:users,username,".$request->get('user_id'),
            'password'=>'required|string|min:6',
            'role_id'=>'required|exists:roles,id'
        ]);

        $user = User::find($request->get('user_id'));

        $user->update([
            'username'=>$request->get('username'),
            'password'=>\Hash::make($request->get('password'))
        ]);
        $role = Role::findById($request->get('role_id'));
        if($user->roles() && $user->roles()->first() && $role->id != $user->roles()->first()->id)
            $user->removeRole($user->roles()->first());
        $user->assignRole($role);
        return \response()->json(['code'=>200,'message'=> trans('lang.user_account_set')]);
    }

    function login()
    {

        return view('uimodule::auth.login');
    }

    function doLogin(Request $request)
    {
        $credencials = $request->validate([
            'username'=>"required|string",
            'password'=>'required|string',
        ]);
        if(auth()->attempt($credencials)){
            return \response()->json(['message'=>'successfully loged in','code'=>200]);
        }else{
            return \response()->json(['message'=> trans('lang.incorrect_username_or_password'),'code'=>201]);
        }
    }

    function logout()
    {
        if (auth()->check())
        {
            auth()->logout();
            return redirect()->to('login');
        }
        return redirect()->back();
    }

    function changeStatus($id)
    {
        $user=User::find($id);
        if($user)
            $user->update(['status'=>$user->status==1?0:1]);
    }
}
