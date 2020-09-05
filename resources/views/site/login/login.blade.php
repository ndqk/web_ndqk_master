@extends('site.layout.master')

@section('css')
<link rel="stylesheet" href="{{asset('site/css/login.css')}}">
@endsection

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(site/img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2 id="category-header">LOGIN</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <section class="login_part section_padding ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>New to our Shop?</h2>
                            <p>There are advances being made in science and technology
                                everyday, and a good example of this is the</p>
                            <a href="{{route('site.register')}}" class="btn_3">Create an Account</a>
                            <hr class="my-4"> 
                                <a href="{{route('socialite.redirect', 'google')}}" class="btn btn-lg btn-google btn-block text-uppercase" type="submit">
                                    <i class="fab fa-google mr-2"></i> Sign in with Google
                                </a> 
                                <a href="{{route('socialite.redirect', 'facebook')}}" class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit">
                                    <i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook
                                </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Welcome Back ! <br>
                                Please Sign in now</h3>
                            <form class="row contact_form" action="{{route('site.login')}}" method="POST" novalidate="novalidate">
                                @csrf
                                <div class="col-md-12 form-group p_star">
                                    <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password">
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account d-flex align-items-center">
                                        <input type="checkbox" id="f-option" name="selector">
                                        <label for="f-option">Remember me</label>
                                    </div>
                                    <button type="submit" value="submit" class="btn_3">
                                        log in
                                    </button>
                                    <a class="lost_pass" href="#">forget password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

