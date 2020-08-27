<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Wordsmith</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{asset('site/css/base.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/vendor.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/main.css')}}">

    <!-- script
    ================================================== -->
    <script src="{{asset('site/js/modernizr.js')}}"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="{{asset('site/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('site/favicon.ico')}}" type="image/x-icon">

</head>

<body id="top">

    {{-- <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div> --}}

    @include('site.partials.header')

    @section('content')
        
    @show


    @include('site.partials.popular')
    @include('site.partials.footer')


    <!-- Java Script
    ================================================== -->
    <script src="{{asset('site/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('site/js/plugins.js')}}"></script>
    <script src="{{asset('site/js/main.js')}}"></script>

</body>

</html>