<?php

namespace App\Http\Controllers\Admin;


use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\EditUserRequest;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function __construct(){
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['showList', 'getList']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit',['only' => ['showEditForm', 'edit']]);
        $this->middleware('permission:user-delete', ['only' => 'delete']);
    }

    public function index(){
        return view('admin.user.list');
    }

    public function getList(){
        $user = User::join('model_has_roles', 'users.id', 'model_has_roles.model_id')
                    ->join('roles', 'roles.id', 'model_has_roles.role_id')
                    ->whereNotIn('roles.name', ['Customer'])
                    ->select('users.id', 'users.name' ,'users.email', 'users.address', 'users.phone', 'roles.name as role');
        
            return Datatables::of($user)->addColumn('action', function($user){
                $string =   '<a href="'.route('user.edit', $user->id).'">Edit </a>';
                $string .=  '<a href="'.route('user.delete', $user->id).'">&emsp;Delete</a>';
                
                return $string;
            })->make(true);
    }

    public function create(){
        $roles = Role::pluck('name','name')->all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(StoreUserRequest $request){
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
        ]);

        $user->assignRole($request->input('role'));

        return redirect()->back()->with('status', 'Thêm thành công');
    }

    public function edit($userId){
        $user = User::findOrFail($userId);
        $roles = Role::pluck('name','name')->all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(EditUserRequest $request, $userId){
        $user = User::findOrFail($userId);
    
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
        ]);        

        $user->syncRoles([$request->input('role')]);
        
        return redirect()->back()->with('status', 'Chỉnh sửa thành công');
    }

    public function destroy($userId){
        $deleteUser = User::findOrFail($userId);
        $deleteUser->delete();
        $deleteModel_has_role = DB::table('model_has_roles')->where('model_id', $userId)->delete();
        return redirect()->back()->with('status', 'Xóa thành công');
    }
}
