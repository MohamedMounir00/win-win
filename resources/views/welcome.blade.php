
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"  dir="{{( app()->getLocale()=='ar')?'rtl':'ltr' }}">
@php

    $lang = LaravelLocalization::getCurrentLocale();

@endphp
<head>
    <meta charset="utf-8">
    <title>Win Win Website</title>

    @if($lang=='ar')
    
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/main-outside-ar.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    @else
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/main-outside-en.css">
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @endif

   
    <link rel="stylesheet" href="{{asset('frontend')}}/css/fakeLoader.min.css">

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
                    @if(Auth::check())


                        <li class="nav-item dropdown">
                            <a class="nav-link last dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{auth()->user()->name}}
                                @if(auth()->user()->image==null)
                                    <img class='img-fluid user-profile-img' src="https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png" alt="">

                                @else
                                    <img class='img-fluid user-profile-img' src="{{url(auth()->user()->image)}}" alt="">

                                @endif
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">


                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ trans('frontend.logout')}}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                       @else
                        <li class="nav-item active">
                            <a class=" nav-link" href="{{route('login')}}">{{trans('frontend.login')}}</a>
                        </li>
                        @endif



                    <li class="nav-item active">
                        @if($lang=='ar')
                        <a class=" last nav-link" style="margin-top: 11px;"  hreflang="{{ 'en' }}" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"> {{trans('frontend.English')}}</a>
                            @else
                            <a class=" last nav-link" style="margin-top: 11px;"  hreflang="{{ 'ar' }}" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"> {{trans('frontend.Arabic')}}</a>
                                  @endif

                    </li>




                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- End Header -->


<!-- Start Introduction Section -->

<section class="intro text-center">
    <div class="container">
        <h1 class="mainHead">Win Win</h1>
        <p class="lead">
         {{trans('frontend.desc_home1')}} . <br> {{trans('frontend.desc_home2')}}
        </p>
        @if(!Auth::check())
        <a style="font-weight: bold;width: 190px;margin: auto;"  href="{{route('register')}}" class="my-btn btn btn-primary btn-block" >{{trans('frontend.register')}}</a>
            @elseif( Auth::check()&& auth()->user()->register=='first_step')
            <a  href="{{route('complete-information-page')}}" class="my-btn btn btn-primary btn-block" >{{trans('frontend.complete-information')}}</a>
@else
            <a  href="{{route('add-unit-page')}}" class="my-btn btn btn-primary btn-block" >{{trans('frontend.add-unit')}}</a>

        @endif
    </div>
</section>

<!-- End Introduction Section -->



<!-- Start Dealing Section -->

<section class="homepage-deal">
    <div class="container">
        <div class="row text-center justify-content-md-center">

            <div class="col-lg-4 col-md-6 col-sm-12">
                <a  class="main">
                    <div data-tilt class="deal-section">
                        <i class="sell-i fa fa-hand-paper-o"></i>
                        <h3>{{trans('frontend.register')}}</h3>
                        <p>                              {{trans('frontend.desc_lorm')}}
                        </p>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">
                <a  class="main">
                    <div data-tilt class="deal-section">
                        <i class="fa fa-road"></i>
                        <h3>{{trans('frontend.add-unit')}}</h3>
                        <p class="lead">                              {{trans('frontend.desc_lorm')}}
                        </p>
                    </div>
                </a>
            </div>


            <div class="col-lg-4 col-md-6 col-sm-12">
                <a  class="main">
                    <div data-tilt class="deal-section">
                        <i class="fa fa-home"></i>
                        <h3>{{trans('frontend.verify_account')}}</h3>
                        <p class="lead">                              {{trans('frontend.desc_lorm')}}
                        </p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- End Dealing Section -->


<!-- Start Footer -->


@include('frontend.partials.footer')


<!-- End Footer -->



