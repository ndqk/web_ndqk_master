<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

use App\Entity\{User, Customer};
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
        $customers = Customer::all();
            return Datatables::of($customers)->addColumn('action', function($customer){
                $string =   '<a href="'.route('customer.edit', $customer->id).'">Edit </a>';
                $string .=  '<a href="'.route('customer.delete', $customer->id).'">&emsp;Delete</a>';
                
                return $string;
            })->make(true);
    }
    //

    public function create(){
        return view('admin.customer.create');
    }

    public function store(StoreUserRequest $request){
        $user = Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->back()->with('status', 'Thêm thành công');
    }

    public function edit($userId){
        $user = Customer::findOrFail($userId);
        return view('admin.customer.edit', compact('user'));
    }

    public function update(EditUserRequest $request, $userId){
        $user = Customer::findOrFail($userId);
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
        
        return redirect()->back()->with('status', 'Chỉnh sửa thành công');
    }

    public function destroy($userId){
        $deleteUser = Customer::findOrFail($userId);
        $deleteUser->delete();
        return redirect()->back()->with('status', 'Xóa thành công');
    }
}
