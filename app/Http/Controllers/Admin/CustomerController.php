<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

use App\Entity\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\EditUserRequest;

use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    function __construct(){
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => 'showList']);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit',['only' =>['showEditForm', 'edit']]);
        $this->middleware('permission:user-delete', ['only' => 'delete']);
    }

    public function index(){
        return view('admin.customer.list');
    }

    public function getList(){
        $user = User::join('model_has_roles', 'users.id', 'model_has_roles.model_id')
                    ->join('roles', 'roles.id', 'model_has_roles.role_id')
                    ->where('roles.name', 'Customer')
                    ->select('users.id', 'users.name' ,'users.email', 'users.address', 'users.phone', 'roles.name as role');
        
            return Datatables::of($user)->addColumn('action', function($user){
                $string =   '<a href="'.route('customer.edit', $user->id).'">Edit </a>';
                $string .=  '<a href="'.route('customer.delete', $user->id).'">&emsp;Delete</a>';
                
                return $string;
            })->make(true);
    }
    //

    public function create(){
        return view('admin.customer.create');
    }

    public function store(StoreUserRequest $request){
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
        ]);

        $user->assignRole('Customer');

        return redirect()->back()->with('status', 'Thêm thành công');
    }

    public function edit($userId){
        $user = User::findOrFail($userId);
        $roles = Role::pluck('name','name')->all();
        return view('admin.customer.edit', compact('user', 'roles'));
    }

    public function update(EditUserRequest $request, $userId){
        $user = User::findOrFail($userId);
        $updateData = [
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'address' => $request->address,
        ];

        if($request->email != $user->email)
            $updateData['email'] = $request->email;
        
        if($request->phone != $user->phone)
            $updateData['phone'] = $request->phone;

        $rules = [
            'email' => 'sometimes|required|unique:users',
            'phone' => 'sometimes|required|unique:users'
        ];
        
        $messages = [
            'email.unique' => 'Email đã được sử dụng',
            'phone.unique' => 'Số điện thoại đã được sử dụng'
        ];

        $validator = Validator::make($updateData, $rules, $messages);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }
        
        $user->update($updateData);        
        $user->syncRoles([$request->role]);
        
        return redirect()->back()->with('status', 'Chỉnh sửa thành công');
    }

    public function destroy($userId){
        $deleteUser = User::findOrFail($userId);
        $deleteUser->delete();
        $deleteModel_has_role = DB::table('model_has_roles')->where('model_id', $userId)->delete();
        return redirect()->back()->with('status', 'Xóa thành công');
    }
}
