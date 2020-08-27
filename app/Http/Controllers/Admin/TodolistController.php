<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Entity\{User, TodoList, UserHasTodo};

class TodolistController extends Controller
{
    function __construct(){
        $this->middleware('permission:todo-list|todo-create|todo-edit|todo-delete', ['only' => 'index']);
        $this->middleware('permission:todo-create', ['only' => 'store']);
        $this->middleware('permission:todo-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:todo-delete', ['only' => 'destroy']);
        $this->middleware('permission:todo-detail', ['only' => 'show']);
        $this->middleware('permission:todo-approve-send', ['only' => 'approveSendRequest']);
        $this->middleware('permission:todo-approve-list', ['only' => 'approveList']);
        $this->middleware('permission:todo-approve-check', ['only' => 'approveChecked']);
        $this->middleware('permission:todo-approve-delete', ['only' => 'approveDelete']);
    }

    public function index()
    {
        $listTodo = TodoList::select('id', 'title', 'deadline')
                                ->with(['users' => function($q){
                                    return $q->with(['user' => function($q){
                                        return $q->select('id','name');
                                    }]);
                                }])
                                ->get();
        return view('admin.todo-list.list', [
            'listTodo' => $listTodo
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::join('model_has_roles', 'users.id', 'model_has_roles.model_id')
                        ->join('roles', 'roles.id', 'model_has_roles.role_id')
                        ->where('roles.name', '<>', 'Admin')
                        ->where('roles.name', '<>', 'Customer')
                        ->select('users.id', 'users.name')->get();
        return view('admin.todo-list.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todoList = [
            'title' => $request->title,
            'content' => $request->content,
            'deadline' => $request->date,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ];
        $storeTodo = new TodoList($todoList);
        $storeTodo->save();

        $users = $request->user;
        foreach($users as $user){
            UserHasTodo::insert(
                ['user_id' => $user, 'todo_id' => $storeTodo->id]
            );
        }     

        return redirect()->back()->with('status', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailTodo = TodoList::findOrFail($id);
        $users = $detailTodo->users()->with(['user' => function($q){
                    return $q->select('id', 'name');
                }])->get();
        return view('admin.todo-list.detail', [
            'detailTodo' => $detailTodo,
            'users' => $users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editTodo = TodoList::with('users')
                            ->findOrFail($id);
        $users = User::join('model_has_roles', 'users.id', 'model_has_roles.model_id')
                        ->join('roles', 'roles.id', 'model_has_roles.role_id')
                        ->where('roles.name', '<>', 'Admin')
                        ->where('roles.name', '<>', 'Customer')
                        ->select('users.id', 'users.name')->get();
        $userChecked = [];
        foreach($editTodo->users as $user){
            $userChecked[] = $user->user_id;
        }
        

        return view('admin.todo-list.edit', [
            'editTodo' => $editTodo,
            'users' => $users,
            'userChecked' => $userChecked
        ]);
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
        $updateTodo = TodoList::findOrFail($id);
        $currentUsers = $updateTodo->users()->get();
        
        UserHasTodo::where('todo_id', $id)->delete();
        foreach($request->users as $user){
            UserHasTodo::insert(
                ['user_id' => $user, 'todo_id' => $id]
            );
        }  

        $updateTodo->save([
            'title' => $request->title,
            'content' => $request->content,
            'deadline' => $request->date,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('status', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteToto = TodoList::findOrFail($id);
        UserHasTodo::where('todo_id', $id)->delete();
        $deleteToto->delete();

        return redirect()->back()->with('status', 'Xóa thành công');
    }

    public function approveSendRequest(Request $request,$id){
        $approveTodo = TodoList::findOrFail($id);
        $approveTodo->status = !$approveTodo->status;
        $approveTodo->save();

        if($approveTodo->status)
            return 'Approving ...';
        else
            return '';

    }

    public function approveList(){
        $listTodo = TodoList::select('id', 'title', 'deadline')
                                ->with(['users' => function($q){
                                    return $q->with(['user' => function($q){
                                        return $q->select('id','name');
                                    }]);
                                }])
                                ->where('status', 1)
                                ->get();
        return view('admin.todo-list.approve.list', [
            'listTodo' => $listTodo
        ]);
    }



    public function approveChecked($id){
        UserHasTodo::where('todo_id', $id)->delete();
        $checkedApprove = TodoList::findOrFail($id);
        $checkedApprove->delete();
        return redirect()->back()->with('status', 'Kiểm duyệt thành công');

    }

    public function approveDelete($id){
        $deleteApprove = TodoList::findOrFail($id);
        $deleteApprove->status = 0;
        $deleteApprove->save();

        return redirect()->back()->with('status', 'Xóa thành công');
    }
}
