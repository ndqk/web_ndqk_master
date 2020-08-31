<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\{UpdateProfileRequest, UpdatePasswordRequest};


class SettingController extends Controller
{
    public function index(Request $request){
        $tab = $request->get('tab') ? $request->get('tab') : 'general';
        $field = $request->get('field');

        $user = Auth::user();

        return view('admin.setting.index' , [
            'user' => $user,
            'tab' => $tab,
            'field' => $field
        ]);
    }

    public function changeInfo(UpdateProfileRequest $request){
        $user = Auth::user();
        $user->update($request->all());
        return redirect()->back()->with('status', 'Cập nhật thành công');
    }

    public function changePassword(UpdatePasswordRequest $request){
        $user = Auth::user();
        if(!Hash::check($request->currPass, $user->password))
            return redirect()->back()->withErrors(['Mật khẩu không chính xác']);
        if($request->newPass === $request->currPass)
            return redirect()->back()->withErrors(['Mật khẩu mới không được trùng với mật khẩu cũ']);
        if($request->newPass !== $request->reNewPass)
            return redirect()->back()->withErrors(['Mật khẩu mới không trùng khớp']);
        $user->password = Hash::make($request->newPass);
        $user->save();
        return redirect()->back()->with('status', 'Cập nhật mật khẩu thành công');
    }
}
