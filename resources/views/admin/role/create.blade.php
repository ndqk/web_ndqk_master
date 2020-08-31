@extends('admin.layout.master')

@section('titleHeader', 'Create Role')
@section('nameRoute', 'Role / Create')

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Role</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form role="form" method="post" action="{{route('role.store')}}">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                    <label>Name Role</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="name">
                    </div>
                </div>
            </div>
            <!-- input states -->
            <div class="row">
                <div class="col-sm-6">
                    <!-- checkbox -->
                    <div class="form-group">
                        @if (sizeof($permissions))
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$permission->name}}" name="permission[]">
                                    <label class="form-check-label">{{$permission->name}}</label>
                                </div>        
                            @endforeach
                        @endif
                        {{-- <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Checkbox</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked>
                            <label class="form-check-label">Checkbox checked</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" disabled>
                            <label class="form-check-label">Checkbox disabled</label>
                        </div> --}}
                    </div>
                </div>
            </div> 
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
  </div>    
@endsection