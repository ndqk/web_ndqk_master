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
                    @foreach ($cartItems as $key => $item)
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex" style="width: 20%">
                                        <img src="upload/image/product/{{$item['image']}}" alt="">
                                    </div>
                                    <div class="media-body">
                                        <p>{{$item['name']}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>${{$item['discount']}}</h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    {{-- <span class="input-number-decrement"> <i class="ti-minus"></i></span> --}}
                                    <input type="text" value="{{$item['quantity']}}" min="0" max="10" size="1">
                                    {{-- <span class="input-number-increment"> <i class="ti-plus"></i></span> --}}
                                </div>
                            </td>
                            <td>
                                <h5>${{$item['quantity'] * $item['discount']}}</h5>
                            </td>
                            <td>
                                <a href="{{route('cart.delete', $key)}}">
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
                
            </tbody>
          </table>
          <div class="checkout_btn_inner float-right">
            <a class="btn_1 btn btn-primary" href="#">Continue Shopping</a>
            <a class="btn_1 checkout_btn_1 btn btn-primary" href="#">Proceed to checkout</a>
          </div>
        </div>
      </div>
  </div>
</section>
@endsection

