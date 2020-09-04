@extends('site.layout.master')

@section('content')
 <!-- ##### Single Product Details Area Start ##### -->
 <section class="single_product_details_area d-flex align-items-center">
    <!-- Single Product Thumb -->
    <div class="single_product_thumb clearfix">
        <div class="product_thumbnail_slides owl-carousel">
            @foreach ($preview_image as $image)
                <img src={{asset('upload/image/product/'. $image->image)}} alt="" >
            @endforeach
            @foreach ($thumbnail_images as $image)
                <img src={{asset('upload/image/product/'. $image->image)}} alt="" >
            @endforeach
        </div>
    </div>

    <!-- Single Product Description -->
    <div class="single_product_desc clearfix">
        <span>{{$category->title}}</span>
        <a href="#">
            <h2>{{$detail_product->name}}</h2>
        </a>
        <p class="product-price">
            @if ($detail_product->discount != $detail_product->price)
                <span class="old-price">${{$detail_product->price}}</span>
            @endif
             ${{$detail_product->discount}}
        </p>
        <p class="product-desc">
            {{\htmlspecialchars_decode($detail_product->description)}}
        </p>

        <!-- Form -->
        <form class="cart-form clearfix" method="post">
            <!-- Select Box -->
            <div class="select-box d-flex mt-50 mb-30">
                @if (sizeof($sizes))
                    <select name="select" id="productSize" class="mr-5">
                        @foreach ($sizes as $size)
                            <option value="{{$size->id}}">Size: {{$size->value}}</option>
                        @endforeach
                    </select>
                @endif
                @if (sizeof($colors))
                    <select name="select" id="productColor">
                        @foreach ($colors as $color)
                            <option value="{{$color->id}}">Color: {{$color->value}}</option>
                        @endforeach
                    </select>
                @endif
            </div>
            <!-- Cart & Favourite Box -->
            <div class="cart-fav-box d-flex align-items-center">
                <!-- Cart -->
                <button type="submit" name="addtocart" value="5" class="btn essence-btn">Add to cart</button>
                <!-- Favourite -->
                <div class="product-favourite ml-4">
                    <a href="#" class="favme fa fa-heart"></a>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- ##### Single Product Details Area End ##### -->
@endsection
