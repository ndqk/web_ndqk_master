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


class UserController extends Controller
{
    function __construct(){
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['showList', 'getList']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit',['only' => ['showEditForm', 'edit']]);
        $this->middleware('permission:user-delete', ['only' => 'delete']);

        $this->middleware('permission:user-permission-list', ['only' => 'show']);
        $this->middleware('permission:user-permission-edit', ['only' => 'updatePermission']);
    }

    public function index(){
        return view('admin.user.list');
    }

    public function getList(){
        $user = User::join('model_has_roles', 'users.id', 'model_has_roles.model_id')
                    ->join('roles', 'roles.id', 'model_has_roles.role_id')
                    ->select('users.id', 'users.name' ,'users.email', 'users.address', 'users.phone', 'roles.name as role');
            
            return Datatables::of($user)->addColumn('action', function($user){
                $string = '<a href="#" class="edit-user-permission-btn" data-id="'.$user->id.'" data-link="'.route('user.show', $user->id).'" data-toggle="modal" data-target="#modal-lg">
                               Permission
                            </a>';
                $string .=   '<a href="'.route('user.edit', $user->id).'"> &emsp;Edit </a>';
                $string .=  '<a href="'.route('user.delete', $user->id).'">&emsp;Delete</a>';
                
                return $string;
            })->make(true);
    }

    public function create(){
        $roles = Role::pluck('name','name')->all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(StoreUserRequest $request){
        try{
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
            ]);
        }catch(Exception $e){
            throw $e->getMessage();
        }

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

    public function show($id){
        $user = User::findOrFail($id);
        $permissionsViaRole = $user->getPermissionsViaRoles()->pluck('name')->toArray();
        $permissionsAll = Permission::select('name')->get()->pluck('name')->toArray();
    
        $permissions = array_diff($permissionsAll, $permissionsViaRole);
    
        $per1 = '';
        foreach($permissionsViaRole as $permission){
            $per1 .= '<div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked disabled>
                            <label class="form-check-label">'.$permission.'</label>
                        </div>
                    </div>';
        }

        $per2 = '';
        foreach($permissions as $permission){
            $per2 .= '<div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="'.$permission.'" '.$this->checkedUserHasPermission($user, $permission).'>
                            <label class="form-check-label">'.$permission.'</label>
                        </div>
                    </div>';
        }
        $res = '<div class="row">
                    <div class="col-sm-12">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Permission via Role ('.$user->getRoleNames().'):</label>
                        </div>
                        <div class="col-sm-12">'.$per1.'</div>
                        <div class="form-group">
                            <label>Permission: </label>
                        </div>
                        <div class="col-sm-12">'.$per2.'</div>
                    </div>
                </div>';
        return $res;
    }

    private function checkedUserHasPermission($user, $permission){
        if($user->hasPermissionTo($permission))
            return 'checked';
    }

    public function updatePermisson(Request $request, $id){
        $user = User::findOrFail($id);
        $permissions = $request->permission;

        $user->syncPermissions($permissions);
        return 'Cập nhật thành công';
    }

    public function destroy($userId){
        $deleteUser = User::findOrFail($userId);
        $deleteUser->delete();
        $deleteModel_has_role = DB::table('model_has_roles')->where('model_id', $userId)->delete();
        return redirect()->back()->with('status', 'Xóa thành công');
    }
}
