<div>
    <table class="table">
        <thead>
            <tr>
                <th colspan="3">Bảo mật và đăng nhập</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <i class="fas fa-key"></i>
                    <strong>Đổi mật khẩu</strong>
                </td>
                <td style="width: 15%">
                    <a href="#" data-toggle="collapse" data-target="#password" onclick="addUrl('tab=security&field=password')">Chỉnh sửa</a>
                </td>
                <tr id="password" class="collapse {{$field=='password' ? 'show active' : ''}}" style="border:none">
                    <td colspan="3">
                        <form role="form" action="{{route('setting.change-password')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="inputCurrPassword">Mật khẩu hiện tại</label>
                                <input name="currPass" type="password" class="form-control" id="inputCurrPassword" >
                            </div>
                            <div class="form-group">
                                <label for="inputNewPassword">Mật khẩu mới</label>
                                <input name="newPass" type="password" class="form-control" id="inputNewPassword" >
                            </div>
                            <div class="form-group">
                                <label for="inputReNewPassword">Nhập lại mật khẩu mới</label>
                                <input name="reNewPass" type="password" class="form-control" id="inputReNewPassword">
                            </div>

                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                            <a class="btn btn-secondary" data-toggle="collapse" data-target="#password">Hủy</a>
                        </form>
                    </td>
                </tr>
            </tr>
        </tbody>
    </table>
</div>