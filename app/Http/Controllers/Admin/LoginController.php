<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Entity\User;
use Spatie\Permission\Models\Role;

use App\Http\Requests\{LoginRequest};

use Session;

class LoginController extends Controller
{
    public function showLoginForm(){
        $roles = Role::where('name','<>', 'Customer')->pluck('name');
        $checkRoles = (array)$roles;
        if(Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole($checkRoles)){
            return redirect()->route('admin.home');
        }
        return view('admin.login.login');
    }

    public function login(LoginRequest $request){
        $user = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        if(Auth::guard('web')->attempt($user)){
            return redirect()->route('admin.home');
        }
        else{
            return redirect()->back()->withErrors(['Email hoặc mật khẩu không chính xác']);
        }
        
    }

    public function logout(){
        if(!Auth::guard('web')->check())
            return redirect()->route('admin.login');
        Auth::guard('web')->logout();
        return redirect()->route('admin.login');
    }
}
