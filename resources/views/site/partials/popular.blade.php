@php
    use App\Entity\Category;
@endphp
<!-- s-extra
    ================================================== -->
    <section class="s-extra">

        <div class="row">

            <div class="col-seven md-six tab-full popular">
                <h3>Popular Posts</h3>

                <div class="block-1-2 block-m-full popular__posts">
                    <article class="col-block popular__post">
                        <a href="{{asset('site/#0')}}" class="popular__thumb">
                            <img src="{{asset('site/images/thumbs/small/tulips-150.jpg')}}" alt="">
                        </a>
                        <h5>10 Interesting Facts About Caffeine.</h5>
                        <section class="popular__meta">
                            <span class="popular__author"><span>By</span> <a href="{{asset('site/#0')}}">John Doe</a></span>
                            <span class="popular__date"><span>on</span> <time datetime="2018-06-14">Jun 14, 2018</time></span>
                        </section>
                    </article>
                    <article class="col-block popular__post">
                        <a href="{{asset('site/#0')}}" class="popular__thumb">
                            <img src="{{asset('site/images/thumbs/small/wheel-150.jpg')}}" alt="">
                        </a>
                        <h5><a href="{{asset('site/#0')}}">Visiting Theme Parks Improves Your Health.</a></h5>
                        <section class="popular__meta">
                            <span class="popular__author"><span>By</span> <a href="{{asset('site/#0')}}">John Doe</a></span>
                            <span class="popular__date"><span>on</span> <time datetime="2018-06-12">Jun 12, 2018</time></span>
                        </section>
                    </article>
                    <article class="col-block popular__post">
                        <a href="{{asset('site/#0')}}" class="popular__thumb">
                            <img src="{{asset('site/images/thumbs/small/shutterbug-150.jpg')}}" alt="">
                        </a>
                        <h5><a href="{{asset('site/#0')}}">Key Benefits Of Family Photography.</a></h5>
                        <section class="popular__meta">
                            <span class="popular__author"><span>By</span> <a href="{{asset('site/#0')}}">John Doe</a></span>
                            <span class="popular__date"><span>on</span> <time datetime="2018-06-12">Jun 12, 2018</time></span>
                        </section>
                    </article>
                    <article class="col-block popular__post">
                        <a href="{{asset('site/#0')}}" class="popular__thumb">
                            <img src="{{asset('site/images/thumbs/small/cookies-150.jpg')}}" alt="">
                        </a>
                        <h5><a href="{{asset('site/#0')}}">Absolutely No Sugar Oatmeal Cookies.</a></h5>
                        <section class="popular__meta">
                            <span class="popular__author"><span>By</span> <a href="{{asset('site/#0')}}"> John Doe</a></span>
                            <span class="popular__date"><span>on</span> <time datetime="2018-06-12">Jun 12, 2018</time></span>
                        </section>
                    </article>
                    <article class="col-block popular__post">
                        <a href="{{asset('site/#0')}}" class="popular__thumb">
                            <img src="{{asset('site/images/thumbs/small/beetle-150.jpg')}}" alt="">
                        </a>
                        <h5><a href="{{asset('site/#0')}}">Throwback To The Good Old Days.</a></h5>
                        <section class="popular__meta">
                            <span class="popular__author"><span>By</span> <a href="{{asset('site/#0')}}">John Doe</a></span>
                            <span class="popular__date"><span>on</span> <time datetime="2018-06-12">Jun 12, 2018</time></span>
                        </section>
                    </article>
                    <article class="col-block popular__post">
                        <a href="{{asset('site/#0')}}" class="popular__thumb">
                            <img src="{{asset('site/images/thumbs/small/salad-150.jpg')}}" alt="">
                        </a>
                        <h5>Healthy Mediterranean Salad Recipes</h5>
                        <section class="popular__meta">
                            <span class="popular__author"><span>By</span> <a href="{{asset('site/#0')}}"> John Doe</a></span>
                            <span class="popular__date"><span>on</span> <time datetime="2018-06-12">Jun 12, 2018</time></span>
                        </section>
                    </article>
                </div> <!-- end popular_posts -->
            </div> <!-- end popular -->

            <div class="col-four md-six tab-full end">
                <div class="row">
                    <div class="col-six md-six mob-full categories">
                        <h3>Categories</h3>
                        @php
                            $categories = Category::all();
                        @endphp
                        <ul class="linklist">
                            @foreach ($categories as $item)
                                <li><a href="{{asset('category/'.$item->slug)}}">{{$item->title}}</a></li>
                            @endforeach
                        </ul>
                    </div> <!-- end categories -->
        
                    <div class="col-six md-six mob-full sitelinks">
                        <h3>Site Links</h3>
        
                        <ul class="linklist">
                            <li><a href="{{route('site.home')}}">Home</a></li>
                            <li><a href="{{route('site.blog')}}">Blog</a></li>
                            <li><a href="{{route('site.about')}}">About</a></li>
                            <li><a href="{{route('site.contact')}}">Contact</a></li>
                        </ul>
                    </div> <!-- end sitelinks -->
                </div>
            </div>
        </div> <!-- end row -->

    </section> <!-- end s-extra -->
