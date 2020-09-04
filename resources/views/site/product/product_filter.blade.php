
    <div class="shop_grid_product_area">
        <div class="row">
            <div class="col-12">
                <div class="product-topbar d-flex align-items-center justify-content-between">
                    <!-- Total Products -->
                    <div class="total-products">
                        <p><span>{{$countProducts}}</span> {{$countProducts > 1 ? 'products' : 'product'}}  found</p>
                    </div>
                    <!-- Sorting -->
                    <div class="product-sorting d-flex">
                        <p>Sort by:</p>
                        <form action="{{\Request::fullUrl()}}" method="post">
                            @php
                                $order = \Request::query('sort', 'new');
                                
                            @endphp
                            <select name="sort" id="sortByselect">
                                <option value="{{\Request::fullUrlWithQuery(['sort' => 'new'])}}" {{$order == 'new' ? 'selected' : ''}}>Newest</option>
                                <option value="{{\Request::fullUrlWithQuery(['sort' => 'price-desc'])}}" {{$order == 'price-desc' ? 'selected' : ''}}>Price: High - Low</option>
                                <option value="{{\Request::fullUrlWithQuery(['sort' => 'price-asc'])}}" {{$order == 'price-asc' ? 'selected' : ''}}>Price: Low - High</option>
                                <option value="{{\Request::fullUrlWithQuery(['sort' => 'rate'])}}" {{$order == 'rate' ? 'selected' : ''}}>Highest Rated</option>
                                <option value="{{\Request::fullUrlWithQuery(['sort' => 'view'])}}" {{$order == 'view' ? 'selected' : ''}}>Highest View</option>
                                <option value="{{\Request::fullUrlWithQuery(['sort' => 'alphabet'])}}" {{$order == 'alphabet' ? 'selected' : ''}}>Name: A - Z</option>
                            </select>
                            <input type="submit" class="d-none" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="list-product">
            @if (sizeof($productFilters))

                @foreach ($productFilters as $product)
                    <!-- Single Product -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="upload/image/product/{{$product->images[0]->image}}" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src={{asset('site/img/product-img/product-2.jpg')}} alt="">

                                <!-- Product Badge -->
                                @if ($product->price == $product->discount)
                                    <div class="product-badge new-badge">
                                        <span>NEW</span>
                                    </div>
                                @else
                                    <div class="product-badge offer-badge">
                                        <span>-{{100 - floor(($product->discount / $product->price)*100)}}%</span>
                                    </div>
                                @endif
                            
                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>

                            <!-- Product Description -->
                            <div class="product-description">
                                <span>{{$product->category->title}}</span>
                                <a href="{{route('product.detail',[$product->category->slug,  $product->slug])}}">
                                    <h6>{{$product->name}}</h6>
                                </a>
                                <p class="product-price">
                                    @if ($product->price != $product->discount)
                                        <span class="old-price"> ${{$product->price}}</span> 
                                    @endif
                                    ${{$product->discount}}
                                </p>

                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="#" class="btn essence-btn">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Không có sản phẩm nào</p>
            @endif
        </div>
    </div>
    <div>
        @if (sizeof($productFilters))
            {{$productFilters->links('site.partials.pagination', ['rangeLimit' => 5])}}
        @endif
    </div>
