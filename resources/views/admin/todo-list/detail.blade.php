@extends('admin.layout.master')

@section('titleHeader', 'To do list')
@section('nameRoute', 'To-do-list / Detail')

@section('content')
@include('partials.alert')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{$detailTodo->title ? $detailTodo->title : ''}}</h3>
        </div>
        <div>
            {!!$detailTodo->content ? $detailTodo->content : ''!!}
        </div>
    </div>
    <div>
        <label for="">User:</label>
        @if ($users)
            @foreach ($users as $user)
                <p>{{$user->user->name}}</p>
            @endforeach
        @endif
    </div>
    <!-- /.card -->
@endsection

