<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(UpdateProfileRequest $request){
        $user = Auth::user();
        $user->update($request->all());
        return redirect()->back()->with('status', 'Cập nhật thành công');
    }
}
