<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Entity\{Post, User, TodoList};
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function home(){
        $countPost = Post::count();
        $countCustomer = User::join('model_has_roles', 'users.id', 'model_has_roles.model_id')
                        ->join('roles', 'roles.id', 'model_has_roles.role_id')
                        ->where('roles.name', 'Admin')->count();

        $currentUser = Auth::user();
        if($currentUser->can(['todo-create', 'todo-edit', 'todo-delete'])){
            $todoList = TodoList::select('id', 'title', 'deadline', 'status')
                                    ->orderBy('deadline', 'asc')->paginate(6);
        }
        else $todoList = TodoList::join('user_has_todos', 'user_has_todos.todo_id', 'id')
                                ->where('user_has_todos.user_id',$currentUser->id)
                                ->select('id', 'title', 'deadline', 'status')
                                ->orderBy('deadline', 'asc')->paginate(6);
        return view('admin.home.home', [
            'countPost' => $countPost,
            'countCustomer' => $countCustomer,
            'todoList' => $todoList
        ]);
    }

}
