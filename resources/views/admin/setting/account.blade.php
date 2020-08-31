{{-- <div class="card-header">
    <h3 class="card-title">Cài đặt tài khoản chung</h3>
</div>
                               --}}
<div >
    <form role="form" action="{{route('setting.change-info')}}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th colspan="3">Cài đặt tài khoản chung</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Tên</strong></td>
                    <td>{{$user->name}}</td>
                    <td >
                        <a href="#" data-toggle="collapse" data-target="#name">Chỉnh sửa</a>
                    </td>
                    <tr id="name" class="collapse" style="border:none">
                        <td colspan="3">
                            <div>
                                <div class="form-group">
                                    <label for="inputName">Cập nhật tên người dùng</label>
                                    <input name="name" type="text" class="form-control" id="inputName" value="{{$user->name}}">
                                </div>
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                                <a class="btn btn-secondary" data-toggle="collapse" data-target="#name">Hủy</a>
                            </div>
                        </td>
                    </tr>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="#" data-toggle="collapse" data-target="#email">Chỉnh sửa</a>
                    </td>
                    <tr id="email" class="collapse" style="border:none">
                        <td colspan="3">
                            <div>
                                <div class="form-group">
                                    <label for="inputEmail1">Cập nhật email</label>
                                    <input name="email" type="email" class="form-control" id="inputEmail1" value="{{$user->email}}">
                                </div>
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                                <a class="btn btn-secondary" data-toggle="collapse" data-target="#email">Hủy</a>
                            </div>
                        </td>
                    </tr>
                </tr>
                <tr>
                    <td><strong>Số điện thoại</strong></td>
                    <td>{{$user->phone}}</td>
                    <td>
                        <a href="#" data-toggle="collapse" data-target="#phone">Chỉnh sửa</a>
                    </td>
                    <tr id="phone" class="collapse" style="border:none">
                        <td colspan="3">
                            <div>
                                <div class="form-group">
                                    <label for="inputPhone">Cập nhật số điện thoại</label>
                                    <input name="phone" type="text" class="form-control" id="inputPhone" value="{{$user->phone}}">
                                </div>
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                                <a class="btn btn-secondary" data-toggle="collapse" data-target="#phone">Hủy</a>
                            </div>
                        </td>
                    </tr>
                </tr>
                <tr>
                    <td><strong>Địa chỉ</strong></td>
                    <td>{{$user->address}}</td>
                    <td>
                        <a href="#" data-toggle="collapse" data-target="#address">Chỉnh sửa</a>
                    </td>
                    <tr id="address" class="collapse" style="border:none">
                        <td colspan="3">
                            <div>
                                <div class="form-group">
                                    <label for="inputAddress">Cập nhật địa chỉ</label>
                                    <input name="address" type="text" class="form-control" id="inputAddress" value="{{$user->address}}">
                                </div>
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                                <a class="btn btn-secondary" data-toggle="collapse" data-target="#address">Hủy</a>
                            </div>
                        </td>
                    </tr>
                </tr>
            </tbody>
        </table>
    </form>
</div>