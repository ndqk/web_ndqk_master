<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Laravel\Socialite\Facades\Socialite;

use App\Entity\User;

use App\Http\Requests\{LoginRequest};

class LoginController extends Controller
{
   
    public function index()
    {
        return view('site.login.login');
    }

    public function login(LoginRequest $request){
        $user = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        if(Auth::attempt($user) && Auth::user()->hasRole('Customer')){
            return redirect()->route('site.home');
        }
        else{
            Auth::logout();
            return redirect()->back()->withErrors(['Email hoặc mật khẩu không chính xác']);
        }
    }
    
    public function logout(){
        if(!Auth::check())
            return redirect()->route('site.login');
        Auth::logout();
        return redirect()->route('site.login');
    }

    public function loginFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook(){
        $user = Socialite::driver('github')->user();
        // dd($user);

    }
}
