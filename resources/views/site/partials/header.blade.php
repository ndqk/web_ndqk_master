@php
    use App\Entity\Category;
@endphp

<!-- header
    ================================================== -->
    <header class="s-header header">

        <div class="header__logo">
            <a class="logo" href="{{route('site.home')}}">
                <img src="{{asset('site/images/logo.svg')}}" alt="Homepage">
            </a>
        </div> <!-- end header__logo -->

        <a class="header__search-trigger" href="#"></a>
        <div class="header__search">

            <form role="search" method="get" class="header__search-form" action="#">
                <label>
                    <span class="hide-content">Search for:</span>
                    <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="Search for:" autocomplete="off">
                </label>
                <input type="submit" class="search-submit" value="Search">
            </form>

            <a href="#" title="Close Search" class="header__overlay-close">Close</a>

        </div>  <!-- end header__search -->

        <a class="header__toggle-menu" href="#" title="Menu"><span>Menu</span></a>
        <nav class="header__nav-wrap">

            <h2 class="header__nav-heading h6">Navigate to</h2>

            <ul class="header__nav">
                <li class="current"><a href="{{route('site.home')}}" title="">Home</a></li>
                <li class="has-children">
                    <a href="#" title="">Categories</a>
                    @php
                        $categories = Category::all();
                    @endphp
                    <ul class="sub-menu">
                        @foreach ($categories as $item)
                            <li><a href="{{asset('category/'.$item->slug)}}">{{$item->title}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="has-children">
                    <a href="{{route('site.blog')}}" title="">Blog</a>
                    <ul class="sub-menu">
                        <li><a href="{{asset('site/single-video.html')}}">Video Post</a></li>
                        <li><a href="{{asset('site/single-audio.html')}}">Audio Post</a></li>
                        <li><a href="{{asset('site/single-standard.html')}}">Standard Post</a></li>
                    </ul>
                </li>
                <li><a href="{{route('site.about')}}" title="">About</a></li>
                <li><a href="{{route('site.contact')}}" title="">Contact</a></li>
            </ul> <!-- end header__nav -->

            <a  title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

        </nav> <!-- end header__nav-wrap -->

    </header> <!-- s-header -->