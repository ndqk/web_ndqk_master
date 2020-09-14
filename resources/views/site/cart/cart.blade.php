<div class="cart-list" tabindex="2" style="overflow: auto; outline: none;">
    <!-- Single Cart Item -->
    @if (isset($cart))
        @php
            $total = 0;
            $discount = 0;
        @endphp
        @foreach ($cart as $key => $item)
            @php
                $total += $item['price'] * $item['quantity'];         
                $discount += $item['discount'] * $item['quantity'];
            @endphp
            <div class="single-cart-item">
                <a href="{{asset('#')}}" class="product-image">
                    <img src="{{asset('/upload/image/product/'.$item['image'])}}" class="cart-thumb" alt="">
                    <!-- Cart Item Desc -->
                    <div class="cart-item-desc">
                        <span class="product-remove">
                            <i class="fa fa-close" aria-hidden="true" data-link="{{route('cart.delete', $key)}}"></i>
                        </span>
                        <span class="badge">Mango</span>
                        <h6>{{$item['name']}}</h6>
                        <p class="size">Quantity: {{$item['quantity']}}</p>
                        
                        {{-- <p class="color">Color: Red</p> --}}
                        <p class="price">${{$item['price']}}</p>
                    </div>
                </a>
            </div>
        @endforeach
    @endif
</div>

@if (isset($cart))
    <!-- Cart Summary -->
    <div class="cart-amount-summary">
        <h2>Summary</h2>
        <ul class="summary-table">
            <li><span>subtotal:</span> <span>$ {{$total ?? 0}} </span></li>
            {{-- <li><span>delivery:</span> <span>Free</span></li> --}}
            <li><span>discount:</span> <span>-{{(isset($discount) && isset($total) && $total != 0) ? (100 - floor(($discount / $total) * 100)) : 0}}%</span></li>
            <li><span>total:</span> <span>${{$discount ?? 0}}</span></li>
        </ul>
        <div class="checkout-btn mt-100">
            <a href="{{route('cart.index')}}" class="btn essence-btn">Detail</a>
        </div>
    </div>
@else
    <div class="cart-amount-summary">
        <h2>Chưa có sản phẩm nào trong giỏ hàng.</h2>
    </div>
@endif
