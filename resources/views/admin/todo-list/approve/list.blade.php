@extends('admin.layout.master')

@section('titleHeader', 'To do list Approve')
@section('nameRoute', 'To-do-list / Approve')

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">To do List Approve</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <thead>                  
          <tr>
            <th style="width: 10px">#</th>
            <th>Title</th>
            <th>Deadline</th>
            <th>Users</th>
            <th style="width: 40px">Action</th>
          </tr>
        </thead>
        <tbody>
            
            @if ($listTodo)
                @foreach ($listTodo as $todo)
                    <tr>
                        <td>{{$todo->id}}</td>
                        <td>{{$todo->title}}</td>   
                        <td>{{$todo->deadline}}</td>
                        <td>
                            @if ($todo->users)
                                @foreach ($todo->users as $user)
                                    <p>{{$user->user->name}}</p>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a href="{{route('todo-list.show', $todo->id)}}" target="_blank">Detail</a>
                            <a href="{{route('todo-list.approve.checked', $todo->id)}}">Checked</a>
                            <a href="{{route('todo-list.approve.delete', $todo->id)}}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    {{-- <div class="card-footer clearfix">
      <ul class="pagination pagination-sm m-0 float-right">
        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
      </ul>
    </div> --}}
  </div>
  <!-- /.card -->
@endsection

