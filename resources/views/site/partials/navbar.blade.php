<!-- ##### Header Area Start ##### -->
<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="{{route('site.home')}}"><img src="{{asset('site/img/core-img/logo.png')}}" alt=""></a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>
            <!-- Menu -->
            <div class="classy-menu">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                    <ul>
                        <li><a href="{{route('site.home')}}">Home</a></li>
                        <li>
                            <a href="{{asset('#')}}">Shop</a>
                            <div class="megamenu">
                                @php
                                    $categories = \App\Entity\Category::whereNull('category_id')
                                                                        ->with('childrenCategories')
                                                                        ->get();
                                @endphp
                                @foreach ($categories as $category)
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">{{$category->title}}</li>
                                        <li><a href="{{route('site.category', $category->slug)}}">All</a></li>
                                        @foreach ($category->childrenCategories as $childCategory)
                                            @include('site.category.child_category', ['child_category' => $childCategory])
                                        @endforeach
                                    </ul> 
                                @endforeach
                                <div class="single-mega cn-col-4">
                                    <img src="{{asset('site/img/bg-img/bg-6.jpg')}}" alt="">
                                </div>
                            </div>
                        </li>
                        {{-- <li><a href="{{asset('site/#')}}">Pages</a>
                            <ul class="dropdown">
                                <li><a href="{{asset('site/index.html')}}">Home</a></li>
                                <li><a href="{{asset('site/shop.html')}}">Shop</a></li>
                                <li><a href="{{asset('site/single-product-details.html')}}">Product Details</a></li>
                                <li><a href="{{asset('site/checkout.html')}}">Checkout</a></li>
                                <li><a href="{{asset('site/blog.html')}}">Blog</a></li>
                                <li><a href="{{asset('site/single-blog.html')}}">Single Blog</a></li>
                                <li><a href="{{asset('site/regular-page.html')}}">Regular Page</a></li>
                                <li><a href="{{asset('site/contact.html')}}">Contact</a></li>
                            </ul>
                        </li> --}}
                        <li><a href="{{route('site.blog')}}">Blog</a></li>
                        <li><a href="{{route('site.about')}}">About</a></li>
                        <li><a href="{{route('site.contact')}}">Contact</a></li>
                    </ul>
                </div>
                <!-- Nav End -->
            </div>
        </nav>

        <!-- Header Meta Data -->
        <div class="header-meta d-flex clearfix justify-content-end">
            <!-- Search Area -->
            <div class="search-area">
                <form action="#" method="post">
                    <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <!-- Favourite Area -->
            <div class="favourite-area">
                <a href="{{asset('#')}}"><img src="{{asset('site/img/core-img/heart.svg')}}" alt=""></a>
            </div>
            @if (\Illuminate\Support\Facades\Auth::guard('customer')->check())
            <div  class="user-login-info">
                <ul>
                    <li class="nav-item dropdown show">
                        <a   data-toggle="dropdown" aria-expanded="true" href="{{asset('#')}}"><img src="{{asset('site/img/core-img/user.svg')}}" alt=""></a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                          {{-- <div class="dropdown-divider"></div> --}}
                          <a href="{{route('customer.profile')}}" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Profile
                          </a>
                          <div class="dropdown-divider"></div>
                          <a href="{{route('site.logout')}}" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                          </a>
                        </div>
                    </li>
                </ul>
            </div>
            @else
                <!-- User Login Info -->
                <div class="user-login-info">
                    <a href="{{route('site.login')}}"><img src="{{asset('site/img/core-img/login.svg')}}" alt=""></a>
                </div>
            @endif
            
            <!-- Cart Area -->
            <div class="cart-area">
                <a href="{{asset('#')}}" id="essenceCartBtn"><img src="{{asset('site/img/core-img/bag.svg')}}" alt=""> <span>3</span></a>
            </div>
        </div>

    </div>
</header>
<!-- ##### Header Area End ##### -->

<!-- ##### Right Side Cart Area ##### -->
<div class="cart-bg-overlay"></div>

<div class="right-side-cart-area">

    <!-- Cart Button -->
    <div class="cart-button">
        <a href="{{asset('#')}}" id="rightSideCart"><img src="{{asset('site/img/core-img/bag.svg')}}" alt=""> <span>3</span></a>
    </div>

    <div class="cart-content d-flex">

        <!-- Cart List Area -->
        <div class="cart-list">
            <!-- Single Cart Item -->
            <div class="single-cart-item">
                <a href="{{asset('#')}}" class="product-image">
                    <img src="{{asset('site/img/product-img/product-1.jpg')}}" class="cart-thumb" alt="">
                    <!-- Cart Item Desc -->
                    <div class="cart-item-desc">
                      <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                        <span class="badge">Mango</span>
                        <h6>Button Through Strap Mini Dress</h6>
                        <p class="size">Size: S</p>
                        <p class="color">Color: Red</p>
                        <p class="price">$45.00</p>
                    </div>
                </a>
            </div>

            <!-- Single Cart Item -->
            <div class="single-cart-item">
                <a href="{{asset('#')}}" class="product-image">
                    <img src="{{asset('site/img/product-img/product-2.jpg')}}" class="cart-thumb" alt="">
                    <!-- Cart Item Desc -->
                    <div class="cart-item-desc">
                      <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                        <span class="badge">Mango</span>
                        <h6>Button Through Strap Mini Dress</h6>
                        <p class="size">Size: S</p>
                        <p class="color">Color: Red</p>
                        <p class="price">$45.00</p>
                    </div>
                </a>
            </div>

            <!-- Single Cart Item -->
            <div class="single-cart-item">
                <a href="{{asset('#')}}" class="product-image">
                    <img src="{{asset('site/img/product-img/product-3.jpg')}}" class="cart-thumb" alt="">
                    <!-- Cart Item Desc -->
                    <div class="cart-item-desc">
                      <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                        <span class="badge">Mango</span>
                        <h6>Button Through Strap Mini Dress</h6>
                        <p class="size">Size: S</p>
                        <p class="color">Color: Red</p>
                        <p class="price">$45.00</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Cart Summary -->
        <div class="cart-amount-summary">

            <h2>Summary</h2>
            <ul class="summary-table">
                <li><span>subtotal:</span> <span>$274.00</span></li>
                <li><span>delivery:</span> <span>Free</span></li>
                <li><span>discount:</span> <span>-15%</span></li>
                <li><span>total:</span> <span>$232.00</span></li>
            </ul>
            <div class="checkout-btn mt-100">
                <a href="{{asset('site/checkout.html')}}" class="btn essence-btn">check out</a>
            </div>
        </div>
    </div>
</div>
<!-- ##### Right Side Cart End ##### -->