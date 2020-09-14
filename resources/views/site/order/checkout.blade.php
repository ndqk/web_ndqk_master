@extends('site.layout.master')

@section('content')
<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb_area bg-img" style="background-image: url(site/img/bg-img/breadcumb.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2>Checkout</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Checkout Area Start ##### -->
<div class="checkout_area section-padding-80">
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-6">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-page-heading mb-30">
                        <h5>Billing Address</h5>
                    </div>

                    <form id="billing-address" action="{{route('order.request')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="first_name">First Name <span>*</span></label>
                                <input name="name" type="text" class="form-control" id="first_name" 
                                    value="{{$billingAddress ? $billingAddress->name : ''}}" 
                                >
                            </div>
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
                            {{-- @if ($billingAddress)
                                <div class="col-12 mb-4" style="display: none">
                                    <button type="submit" class="btn essence-btn">Update</button>
                                </div>
                            @else
                                <div class="col-12 mb-4">
                                    <button type="submit" class="btn essence-btn">Create</button>
                                </div>
                            @endif --}}
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                <div class="order-details-confirmation">

                    <div class="cart-page-heading">
                        <h5>Your Order</h5>
                        <p>The Details</p>
                    </div>

                    <ul class="order-details-form mb-4">
                        <li><span>Product</span> <span>Total</span></li>
                        @php
                            $subtotal = 0;
                            $shipping = 0;
                        @endphp
                        @foreach ($cartItems as $item)
                            @php
                                $subtotal += $item->product->discount * $item->quantity;
                            @endphp
                            <li><span>{{$item->product->name}}({{$item->quantity}})</span> <span>${{$item->product->discount * $item->quantity}}</span></li>
                        @endforeach
                        <li><span>Subtotal</span> <span>${{$subtotal}}</span></li>
                        <li><span>Shipping</span> <span>{{$shipping ? $shipping : 'Free'}}</span></li>
                        <li><span>Total</span> <span>${{$subtotal + $shipping}}</span></li>
                    </ul>

                    <div id="accordion" role="tablist" class="mb-4">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i class="fa fa-circle-o mr-3"></i>Paypal</a>
                                </h6>
                            </div>

                            <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integ er bibendum sodales arcu id te mpus. Ut consectetur lacus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h6 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-circle-o mr-3"></i>cash on delievery</a>
                                </h6>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quis in veritatis officia inventore, tempore provident dignissimos.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingThree">
                                <h6 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-circle-o mr-3"></i>credit card</a>
                                </h6>
                            </div>
                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quo sint repudiandae suscipit ab soluta delectus voluptate, vero vitae</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingFour">
                                <h6 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour"><i class="fa fa-circle-o mr-3"></i>direct bank transfer</a>
                                </h6>
                            </div>
                            <div id="collapseFour" class="collapse show" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est cum autem eveniet saepe fugit, impedit magni.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button id="checkout-submit" class="btn essence-btn">Place Order</button>
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
            $(document).on('click', '#checkout-submit',function(){
                $('#billing-address').submit();
            });
        });
    </script>
@endpush