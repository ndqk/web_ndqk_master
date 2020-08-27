@extends('admin.layout.master')

@section('titleHeader', 'Create Customer')
@section('nameRoute', 'Crete Customer')


@section('content')
@include('partials.alert')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm mới tài khoản thành viên</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" method="post" action="{{route('customer.store')}}">
      @csrf
      <div class="card-body">
        <div class="form-group">
            <label for="InputName">Tên chủ sở hữu *</label>
            <input type="text" name="name" class="form-control" id="InputName" placeholder="Name" required>
        </div>
        <div class="form-group">
          <label for="InputEmail1">Email *</label>
          <input type="email" name="email" class="form-control" id="InputEmail1" placeholder="Email" required>
        </div>
        <div class="form-group">
          <label for="InputPassword1">Mật khẩu *</label>
          <input type="password" name="password" class="form-control" id="InputPassword1" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label for="InputAddress">Địa chỉ *</label>
            <input type="text" name="address" class="form-control" id="InputAddress" placeholder="Address" required>
        </div>
        <div class="form-group">
            <label for="InputPhone">Số điện thoại *</label>
            <input type="text" name="phone" class="form-control" id="InputPhone" placeholder="Phone" required>
        </div>
        
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection

