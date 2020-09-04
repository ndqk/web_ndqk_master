<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Title  -->
    <title>Essence - Fashion Ecommerce Template</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{asset('site/img/core-img/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{asset('site/css/core-style.css')}}">
    <link rel="stylesheet" href="{{asset('site/style.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"  crossorigin="anonymous" />

    @yield('css')
    @yield('style')

</head>

<body>
    @include('site.partials.navbar')
    
    @section('content')
        
    @show
    
    @include('site.partials.footer')

    <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{asset('site/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('site/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('site/js/bootstrap.min.js')}}"></script>
    <!-- Plugins js -->
    <script src="{{asset('site/js/plugins.js')}}"></script>
    <!-- Classy Nav js -->
    <script src="{{asset('site/js/classy-nav.min.js')}}"></script>
    <!-- Active js -->
    {{-- <script src="{{asset('site/js/active.js')}}"></script>
    <!-- Google Maps --> --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwuyLRa1uKNtbgx6xAJVmWy-zADgegA2s"></script>
    <!-- Active js -->
    <script src="{{asset('site/js/active.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous"></script>


    @include('partials.alert')

    @yield('js')
    @stack('script')

</body>

</html>