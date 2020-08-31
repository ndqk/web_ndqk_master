@extends('admin.layout.master')

@section('titleHeader', 'Profile')
@section('nameRoute', 'Profile')

@section('content')
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-5">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="../../dist/img/user4-128x128.jpg"
                            alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{$user->name}}</h3>

                    <p class="text-muted text-center">{{$user->roles[0]->name}}</p>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                    <p class="text-muted">{{$user->address}}</p>

                    <hr>

                    <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                    <p class="text-muted">{{$user->email}}</p>

                    <hr>

                    <strong><i class="fas fa-phone mr-1"></i> Phone</strong>

                    <p class="text-muted">{{$user->phone}}</p>

                    <hr>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-7">
            
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">SETTING</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('profile.update')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Name *</label>
                            <input type="text" name="name" class="form-control"  placeholder="Enter name" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email *</label>
                            <input type="email" name="email" class="form-control"  placeholder="Enter email" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Address *</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter address" value="{{$user->address}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone *</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter phone" value="{{$user->phone}}">
                        </div>
                        
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    
    </div>
  <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
@endsection