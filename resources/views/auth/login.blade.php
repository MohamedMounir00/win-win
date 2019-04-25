
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"  dir="{{( app()->getLocale()=='ar')?'rtl':'ltr' }}">
@php

    $lang = LaravelLocalization::getCurrentLocale();

@endphp
<head>
    <meta charset="utf-8">
    <title>Win Win Website</title>

    @if($lang=='ar')
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">   
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/main-outside-ar.css">

    @else
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/main-outside-en.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @endif

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/fakeLoader.min.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
</head>

<body>

<!-- PAge Loading -->
<div class="fakeLoader"></div>


<!-- Start Header -->
<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="{{asset('frontend')}}/images/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <!-- Navbar Lists -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar Lists -->
                <ul class="navbar-nav ml-auto">

                        <li class="nav-item active">
                            <a class=" nav-link" href="{{route('register')}}">{{trans('frontend.register')}}</a>
                        </li>




                    <li class="nav-item active">
                        @if($lang=='ar')
                            <a class=" nav-link last"  hreflang="{{ 'en' }}" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"> {{trans('frontend.English')}}</a>
                        @else
                            <a class=" nav-link last"  hreflang="{{ 'ar' }}" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"> {{trans('frontend.Arabic')}}</a>
                        @endif

                    </li>




                </ul>
            </div>
        </div>
    </nav>
</header>


<!-- End Header -->


<!-- Start Login Section -->

<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-6 nopadding">
                <div class="login-image">
                    <img class="img-fluid" src="{{asset('frontend')}}/images/login-img.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="login-form">

                    <h2>{{trans('frontend.login')}}</h2>

                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{trans('frontend.Email')}}</label>

                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                        <div class="form-group ">
                            <label for="password" >{{trans('frontend.Password')}}</label>

                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>



                        <button type="submit" class="my-btn btn btn-primary">{{trans('frontend.login')}}</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- End Login Section -->



<!-- Start Footer -->

@include('frontend.partials.footer')


