<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Entity\{Customer};

use App\Http\Requests\{RegisterRequest};

class RegisterController extends Controller
{
    public function index(){
        return view('site.login.register');
    }

    public function register(RegisterRequest $request){
        $newCustomer = new Customer([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->password,
            'password' => Hash::make($request->password),
            'password_status' => 1
        ]);
        $newCustomer->save();

        return redirect()->route('site.login')->with('status', 'Tạo tài khoản thành công');
    }
}
