@php
     $categories = \App\Entity\Category::whereNull('category_id')
                                ->with('childrenCategories')
                                ->get();
@endphp
<div class="col-12 col-md-4 col-lg-3">
    <div class="shop_sidebar_area">

        <!-- ##### Single Widget ##### -->
        <div class="widget catagory mb-50">
            <!-- Widget Title -->
            <h6 class="widget-title mb-30">Catagories</h6>

            <!--  Catagories  -->
            <div class="catagories-menu">
                <ul id="menu-content2" class="menu-content collapse show">
                    <!-- Single Item -->
                    @foreach ($categories as $category)
                        <li data-toggle="collapse" data-target="#{{$category->slug}}">
                            <a href="#">{{$category->title}}</a>
                            <ul class="sub-menu collapse {{$parentCategory->slug == $category->slug ? 'show' : ''}}" id="{{$category->slug}}">
                                @foreach ($category->childrenCategories as $childCategory)
                                    @include('site.category.filter_category', ['child_category' => $childCategory, 'currCategoey' => $currCategory])
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- ##### Single Widget ##### -->
        <div class="widget price mb-50">
            <!-- Widget Title -->
            <h6 class="widget-title mb-30">Filter by</h6>
            <!-- Widget Title 2 -->
            <p class="widget-title2 mb-30">Price</p>

            <div class="widget-desc">
                <div class="slider-range">
                    <div data-min="0" data-max="1000000" data-unit="$" 
                        class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                        data-value-min="0" data-value-max="1000000" data-label-result="Range:">
                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                    </div>
                    <div class="range-price">Range: $0.00 - $1000000.00</div>
                </div>
            </div>
        </div>

        <!-- ##### Single Widget ##### -->
        <div class="widget color mb-50">
            <!-- Widget Title 2 -->
            <p class="widget-title2 mb-30">Color</p>
            <div class="widget-desc">
                <ul class="d-flex">
                    <li><a href="#" class="color1"></a></li>
                    <li><a href="#" class="color2"></a></li>
                    <li><a href="#" class="color3"></a></li>
                    <li><a href="#" class="color4"></a></li>
                    <li><a href="#" class="color5"></a></li>
                    <li><a href="#" class="color6"></a></li>
                    <li><a href="#" class="color7"></a></li>
                    <li><a href="#" class="color8"></a></li>
                    <li><a href="#" class="color9"></a></li>
                    <li><a href="#" class="color10"></a></li>
                </ul>
            </div>
        </div>

        {{-- <!-- ##### Single Widget ##### -->
        <div class="widget brands mb-50">
            <!-- Widget Title 2 -->
            <p class="widget-title2 mb-30">Brands</p>
            <div class="widget-desc">
                <ul>
                    <li><a href="#">Asos</a></li>
                    <li><a href="#">Mango</a></li>
                    <li><a href="#">River Island</a></li>
                    <li><a href="#">Topshop</a></li>
                    <li><a href="#">Zara</a></li>
                </ul>
            </div>
        </div> --}}
    </div>
</div>