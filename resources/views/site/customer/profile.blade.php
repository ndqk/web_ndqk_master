@extends('site.layout.master')

@section('content')
 <!-- ##### Breadcumb Area Start ##### -->
 <div class="breadcumb_area bg-img" style="background-image: url(site/img/bg-img/breadcumb.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2 id="category-header">PROFILE</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->
<div class="checkout_area">
    <div class="container section-padding-80">
        <div class="row">

            <div class="col-12 col-md-6">
                <form class="order-details-confirmation" action="{{route('customer.profile.update')}}" method="POST">
                    @csrf
                    <div class="cart-page-heading">
                        <h5>Thông tin cá nhân</h5>
                    </div>
                    <ul class="order-details-form mb-4">
                        <li>
                            <span>{{$customer->name}}</span> 
                            <span><a class="eidt-profile" href="#" data-toggle="collapse" data-target="#name" style="color:blue">Chỉnh sửa</a></span>
                        </li>
                            <div id="name" class="collapse row {{in_array('name', $tabs) ? 'show' : ''}}" style="border:none">
                                <div>
                                    <div class="form-group">
                                        <label for="inputName">Cập nhật tên người dùng</label>
                                        <input name="name" type="text" class="form-control" id="inputName" value="{{$customer->name}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                    <a class="btn btn-secondary" data-toggle="collapse" data-target="#name">Hủy</a>    
                                </div>
                            </div>
                        <li>
                            <span>{{$customer->email}}</span> 
                            <span><a class="eidt-profile" href="#" data-toggle="collapse" data-target="#email" style="color:blue">Chỉnh sửa</a></span>
                        </li>
                            <div id="email" class="collapse row {{in_array('email', $tabs) ? 'show' : ''}}" style="border:none">
                                <div>
                                    <div class="form-group">
                                        <label for="inputEmail">Cập nhật email</label>
                                        <input name="email" type="text" class="form-control" id="inputEmail" value="{{$customer->email}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                    <a class="btn btn-secondary" data-toggle="collapse" data-target="#emai">Hủy</a>    
                                </div>
                            </div>
                        <li>
                            @if ($customer->phone)
                                <span>{{$customer->phone}}</span> 
                            @endif
                            <span><a class="eidt-profile" href="#" data-toggle="collapse" data-target="#phone" style="color:blue">{{$customer->phone ? 'Chỉnh sửa' : 'Thêm số điện thoại'}}</a></span>
                        </li>
                            <div id="phone" class="collapse row {{in_array('phone', $tabs) ? 'show' : ''}}" style="border:none">
                                <div>
                                    <div class="form-group">
                                        <label for="inputPhone">Cập nhật số điện thoại</label>
                                        <input name="phone" type="text" class="form-control" id="inputPhone" value="{{$customer->phone}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                    <a class="btn btn-secondary" data-toggle="collapse" data-target="#phone">Hủy</a>    
                                </div>
                            </div>
                        <li>
                            @if ($customer->address)
                                <span>{{$customer->address}}</span> 
                            @endif
                            <span><a class="eidt-profile" href="#" data-toggle="collapse" data-target="#address" style="color:blue">{{$customer->address ? 'Chỉnh sửa' : 'Thêm địa chỉ'}}</a></span>
                        </li>
                            <div id="address" class="collapse row {{in_array('address', $tabs) ? 'show' : ''}}" style="border:none">
                                <div>
                                    <div class="form-group">
                                        <label for="inputAddress">Cập nhật địa chỉ</label>
                                        <input name="address" type="text" class="form-control" id="inputAddress" value="{{$customer->address}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                    <a class="btn btn-secondary" data-toggle="collapse" data-target="#address">Hủy</a>    
                                </div>
                            </div>
                    </ul>
                </form>
                <form  class="order-details-confirmation" action="{{route('customer.change.password')}}" method="POST">
                    @csrf
                    <ul  class="order-details-form mb-4">
                        <li>
                            @if (!$customer->password_status)
                                <span><a class="eidt-profile" href="#" data-toggle="collapse" data-target="#password" style="color:blue">Thêm mật khẩu</a></span>
                            @else
                                <span>Đổi mật khẩu</span> 
                                <span><a class="eidt-profile" href="#" data-toggle="collapse" data-target="#password" style="color:blue">Chỉnh sửa</a></span>
                            @endif
                        </li>
                            <div id="password" class="collapse row {{in_array('password', $tabs) ? 'show' : ''}}" style="border:none">
                                <div>
                                    @if ($customer->password_status)
                                        <div class="form-group">
                                            <label for="inputCurr">Mật khẩu hiện tại</label>
                                            <input name="currpass" type="password" class="form-control" id="inputCurr" value="">
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputNew">Mật khẩu mới</label>
                                        <input name="newpass" type="password" class="form-control" id="inputNew" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputRe">Nhập lại mật khẩu</label>
                                        <input name="renewpass" type="password" class="form-control" id="inputRe" value="">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                    <a class="btn btn-secondary" data-toggle="collapse" data-target="#password">Hủy</a>    
                                </div>
                            </div>
                    </ul>
                    
                </form>
                
            </div>

            <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                <div class="checkout_details_area clearfix">

                    <div class="cart-page-heading mb-30">
                        <h5>Billing Address</h5>
                    </div>

                    <form action="{{route('customer.billing.address.create')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="first_name">First Name <span>*</span></label>
                                <input name="name" type="text" class="form-control" id="first_name" 
                                    value="{{$billingAddress ? $billingAddress->name : ''}}" 
                                >
                            </div>
                            {{-- <div class="col-md-6 mb-3">
                                <label for="last_name">Last Name <span>*</span></label>
                                <input name="last_name" type="text" class="form-control" id="last_name" value="" >
                            </div> --}}
                            <div class="col-12 mb-3" >
                                <label for="province">Province <span>*</span></label>
                                <select size="1" name="province" class="w-100" id="province">
                                    @foreach ($provinces as $province)
                                        <option value="{{$province->id}}" {{($billingAddress && $billingAddress->province_id == $province->id) ? 'selected' : ''}}>
                                            {{$province->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="district">District <span>*</span></label>
                                <select size="1" name="district" class="w-100" id="district">
                                    @foreach ($districts as $district)
                                        <option value="{{$district->id}}" {{($billingAddress && $billingAddress->district_id == $district->id) ? 'selected' : ''}}>{{$district->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="ward">Ward <span>*</span></label>
                                <select size="1" name="ward" class="w-100" id="ward">
                                    @foreach ($wards as $ward)
                                        <option value="{{$ward->id}}" {{($billingAddress && $billingAddress->ward_id == $ward->id) ? 'selected' : ''}}>{{$ward->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="street_address">Address <span>*</span></label>
                                <input name="street_address" type="text" class="form-control mb-3" id="street_address" value="{{$billingAddress ? $billingAddress->address : ''}}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone_number">Phone No <span>*</span></label>
                                <input name="phone" type="number" class="form-control" id="phone_number" min="0" value="{{$billingAddress ? $billingAddress->phone : ''}}">
                            </div>
                            <div class="col-12 mb-4">
                                <label for="email_address">Email Address <span>*</span></label>
                                <input name="email" type="email" class="form-control" id="email_address" value="{{$billingAddress ? $billingAddress->email : ''}}">
                            </div>
                            @if ($billingAddress)
                                <div class="col-12 mb-4" style="display: none">
                                    <button type="submit" class="btn essence-btn">Update</button>
                                </div>
                            @else
                                <div class="col-12 mb-4">
                                    <button type="submit" class="btn essence-btn">Create</button>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Checkout Area End ##### -->
@endsection

@push('script')
    <script>
        $(function(){
            $(document).on('click', '.eidt-profile', function(){
                let tab = $(this).data('target').slice(1);
                let url = window.location.href;
                if(url.indexOf(tab) === -1)
                    if(url.indexOf("?") === -1)
                        url = url + '?tab[]=' + tab;
                    else
                        url = url + '&tab[]=' + tab;
                else{
                    let index = url.indexOf(tab);
                    url = url.slice(0, index - 7).concat(url.slice(index + tab.length));
                    if(url.indexOf("?") === -1){
                        let index = url.indexOf("&");
                        if(index !== -1)
                            url = url.slice(0, index) + "?" + url.slice(index + 1);
                    }
                    //console.log(url);
                }
                history.pushState({}, null, url);
            });

            $(document).on('change', 'select[name=province]', function(){
                let province = $(this).val();
                let url = 'location/district/' + province;
                $.ajax({
                    type: 'GET',
                    url : url,
                    success: function(res){
                        //console.log(res);
                        $('select[name=district]').html(res);
                        let district = $('select[name=district]').val();
                        let url = 'location/ward/' + district;
                            $.ajax({
                                type: 'GET',
                                url : url,
                                success: function(res){
                                    //console.log(res);
                                    $('select[name=ward]').html(res);
                                }
                            });
                        }
                });
            });

            $(document).on('change', 'select[name=district]', function(){
                let district = $(this).val();
                let url = 'location/ward/' + district;
                $.ajax({
                    type: 'GET',
                    url : url,
                    success: function(res){
                        //console.log(res);
                        $('select[name=ward]').html(res);
                    }
                });
            });
        });
    </script>
@endpush