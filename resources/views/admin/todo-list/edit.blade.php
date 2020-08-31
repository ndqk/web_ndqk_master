@extends('admin.layout.master')

@section('titleHeader', 'Edit To to list')
@section('nameRoute', 'To-do-list / Edit')

@section('css')
    <link rel="stylesheet" href="{{asset('site/css/preview.css')}}">
@endsection

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Chỉnh sửa bài viết</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="create-post-form" role="form" method="post" action="{{route('todo-list.update', $editTodo->id)}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="card-body">
        <div class="form-group">
            <label for="InputName">Title *</label>
            <input type="text" name="title" id="InputName" class="form-control" placeholder="Title" autocomplete="off" 
            value="{{$editTodo->title ? $editTodo->title : ''}}">
        </div>
        <div class="form-group">
            <label for="InputDate">Deadline *</label>
            <input type="date" name="date" id="InputDate" class="form-control" placeholder="Date" 
            value="{{$editTodo->deadline ? $editTodo->deadline : ''}}">
        </div>
        <div class="form-group">
            <label for="InputCategory">User *:</label>
            @if ($users)
                @foreach ($users as $user)
                    
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{$user->id}}" id="{{$user->id}}" name="user[]"
                    {{in_array($user->id, $userChecked) ? 'checked' : ''}}>
                    <label class="form-check-label">{{$user->name}}</label>
                </div>
              
                @endforeach
            @endif
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <strong>Content</strong>
                        </h3>
                        <!-- tools box -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                            <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                            <i class="fas fa-times"></i></button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pad">
                        <div class="mb-3">
                            <textarea form="create-post-form" name="content" class="textarea" placeholder="Place some text here"
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{$editTodo->content ? $editTodo->content : ''}}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        {{-- <div class="form-group">
            <label for="InputStatus">Status</label>
            <select name="status" id="InputStatus" class="custom-select">
                <option value="0">Off</option>
                <option value="1">On</option>
            </select>
        </div> --}}
        
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    
  </div>

@endsection
