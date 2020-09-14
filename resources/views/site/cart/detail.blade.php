@extends('site.layout.master')

@section('css')
{{-- <link rel="stylesheet" href="{{asset('site/cart/style.css')}}"> --}}
@show

@section('content')
 <!-- ##### Breadcumb Area Start ##### -->
 <div class="breadcumb_area bg-img" style="background-image: url(site/img/bg-img/breadcumb.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2 id="category-header">CART LIST</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<section class="cart_area" style="padding-bottom: 80px">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
          <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="width: 60%">Product</th>
                    <th scope="col" style="width: 10%">Price</th>
                    <th scope="col" style="width: 10%">Quantity</th>
                    <th scope="col" style="width: 10%">Total</th>
                    <th scope="col" style="width: 10%"></th>
                </tr>
            </thead>
            <tbody>
                {{-- {{$cartItems}} --}}
                @if ($cartItems)
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex" style="width: 20%">
                                        <img src="upload/image/product/{{$item->product->images[0]->image}}" alt="">
                                    </div>
                                    <div class="media-body">
                                        <p>{{$item->product->name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>${{$item->product->discount}}</h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    {{-- <span class="input-number-decrement"> <i class="ti-minus"></i></span> --}}
                                    <input type="text" value="{{$item->quantity}}" min="0" max="10" size="1">
                                    {{-- <span class="input-number-increment"> <i class="ti-plus"></i></span> --}}
                                </div>
                            </td>
                            <td>
                                <h5>${{$item->quantity * $item->product->discount}}</h5>
                            </td>
                            <td>
                                <a href="{{route('cart.delete', $item->id)}}">
                                    <i class="fas fa-close"></i>
                                </a>
                            </td>
                        </tr> 
                    @endforeach
                @endif
                
                <tr class="bottom_button">
                    <td>
                        <a class="btn_1 btn btn-primary" href="#">Update Cart</a>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="cupon_text float-right">
                            <a class="btn_1 btn btn-primary" href="#">Close Coupon</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                    <h5>Subtotal</h5>
                    </td>
                    <td>
                    <h5>$2160.00</h5>
                    </td>
                </tr>
                {{-- <tr class="shipping_area">
                    <td></td>
                    <td></td>
                    <td>
                    <h5>Shipping</h5>
                    </td>
                    <td>
                    <div class="shipping_box">
                        <ul class="list">
                        <li>
                            Flat Rate: $5.00
                            <input type="radio" aria-label="Radio button for following text input">
                        </li>
                        <li>
                            Free Shipping
                            <input type="radio" aria-label="Radio button for following text input">
                        </li>
                        <li>
                            Flat Rate: $10.00
                            <input type="radio" aria-label="Radio button for following text input">
                        </li>
                        <li class="active">
                            Local Delivery: $2.00
                            <input type="radio" aria-label="Radio button for following text input">
                        </li>
                        </ul>
                        <h6>
                        Calculate Shipping
                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </h6>
                        <select class="shipping_select" style="display: none;">
                        <option value="1">Bangladesh</option>
                        <option value="2">India</option>
                        <option value="4">Pakistan</option>
                        </select><div class="nice-select shipping_select" tabindex="0"><span class="current">Bangladesh</span><ul class="list"><li data-value="1" class="option selected">Bangladesh</li><li data-value="2" class="option">India</li><li data-value="4" class="option">Pakistan</li></ul></div>
                        <select class="shipping_select section_bg" style="display: none;">
                        <option value="1">Select a State</option>
                        <option value="2">Select a State</option>
                        <option value="4">Select a State</option>
                        </select><div class="nice-select shipping_select section_bg" tabindex="0"><span class="current">Select a State</span><ul class="list"><li data-value="1" class="option selected">Select a State</li><li data-value="2" class="option">Select a State</li><li data-value="4" class="option">Select a State</li></ul></div>
                        <input class="post_code" type="text" placeholder="Postcode/Zipcode">
                        <a class="btn_1" href="#">Update Details</a>
                    </div>
                    </td>
                </tr> --}}
            </tbody>
          </table>
          <div class="checkout_btn_inner float-right">
            <a class="btn_1 btn btn-primary" href="#">Continue Shopping</a>
            <a class="btn_1 checkout_btn_1 btn btn-primary" href="{{route('checkout.index')}}">Proceed to checkout</a>
          </div>
        </div>
      </div>
  </div>
</section>
@endsection

