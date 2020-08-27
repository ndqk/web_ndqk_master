<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function __construct(){
        $this->middleware('permission:role-list|role-edit|role-create|role-delete', ['only' => 'index']);
        $this->middleware('permission:role-edit', ['only' => ['update']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'ASC')->get();
        return view('admin.role.list', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::select('id', 'name')->get();
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::select('id', 'name')->get();
        
        $temp = '';

        foreach($permissions as $permission){
            $temp .= '<div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="'.$permission->name.'"'.$this->checkedRoleHasPermission($role, $permission->name).' >
                            <label class="form-check-label">'.$permission->name.'</label>
                        </div>
                    </div>';
        }
        $res = '<div class="row">
                    <div class="col-sm-12">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Role: '.$role->name.'</label>
                        </div>
                        <div class="form-group">
                            <label>Permission: </label>
                        </div>
                        <div class="col-sm-12">'.$temp.'</div>
                    </div>
                </div>';
        return $res;
    }

    private function checkedRoleHasPermission($role, $permission){
        if($role->hasPermissionTo($permission))
            return 'checked';
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->input('permission');

        $role->syncPermissions($permissions);

        return '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5>
                        <i class="icon fas fa-check"></i>
                        Cập nhật thành công
                    </h5>
                </div>';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
