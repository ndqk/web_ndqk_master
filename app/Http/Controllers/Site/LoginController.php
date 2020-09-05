<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Laravel\Socialite\Facades\Socialite;

use App\Entity\{User, Customer};

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
        if(Auth::guard('customer')->attempt($user)){
            return redirect()->route('customer.profile');
        }
        else{
            Auth::guard('customer')->logout();
            return redirect()->back()->withErrors(['Email hoặc mật khẩu không chính xác']);
        }
    }
    
    public function logout(){
        if(!Auth::guard('customer')->check())
            return redirect()->route('site.login');
        Auth::guard('customer')->logout();
        return redirect()->route('site.login');
    }

    public function redirect($driver){
        return Socialite::driver($driver)->redirect();
    }

    public function callback($driver){
        try{
            $user = Socialite::driver($driver)->user();
            // dd($user);
        }catch(\Exception $e){
            return redirect()->route('site.login');
        }

        $existUser = Customer::where('email', $user->getEmail())->first();

        if(!$existUser){
            $existUser = new Customer([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'socialite_id' => $user->getId(),
                'socialite_name' => $driver,
                'password' => $user->token,
                'password_status' => 0
            ]);
            $existUser->save();
        }else{
            if(!$existUser->socialite_id){
                return redirect()->route('site.login')->withErrors(['Tài khoản email đã được sử dụng cho 1 tài khoản khác']);
            }
        }
        Auth::guard('customer')->login($existUser);
        return redirect()->route('customer.profile');

    }
}
