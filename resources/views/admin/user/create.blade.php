@extends('admin.layout.master')

@section('titleHeader', 'Create User')
@section('nameRoute', 'Create User')

@section('content')
@include('partials.alert')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm mới tài khoản quản trị</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" method="post" action="{{route('user.store')}}">
      @csrf
      <div class="card-body">
        <div class="form-group">
            <label for="InputName">Tên chủ sở hữu *</label>
            <input type="text" name="name" class="form-control" id="InputName" placeholder="Name" >
        </div>
        <div class="form-group">
          <label for="InputEmail1">Email *</label>
          <input type="email" name="email" class="form-control" id="InputEmail1" placeholder="Email" >
        </div>
        <div class="form-group">
          <label for="InputPassword1">Mật khẩu *</label>
          <input type="password" name="password" class="form-control" id="InputPassword1" placeholder="Password" >
        </div>
        <div class="form-group">
            <label for="InputAddress">Địa chỉ *</label>
            <input type="text" name="address" class="form-control" id="InputAddress" placeholder="Address" >
        </div>
        <div class="form-group">
            <label for="InputPhone">Số điện thoại *</label>
            <input type="text" name="phone" class="form-control" id="InputPhone" placeholder="Phone">
        </div>
        <div class="form-group">
            <label for="InputRole">Chức vụ</label>
            <select name="role" id="InputRole" class="custom-select">
                @foreach ($roles as $role)
                  <option value="{{$role}}">{{$role}}</option>
                @endforeach
            </select>
        </div>
        
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection

