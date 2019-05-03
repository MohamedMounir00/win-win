
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"  dir="{{( app()->getLocale()=='ar')?'rtl':'ltr' }}">
@php

    $lang = LaravelLocalization::getCurrentLocale();

@endphp
<head>
    <meta charset="utf-8">
    <title>Win Win Website</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link rel="stylesheet" href="{{asset('frontend')}}/css/uploadfile.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/lightbox.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/public-css.css">
    @yield('styles')
  
    <style type="text/css">
         /* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('{{asset('frontend/images/loading.gif')}}') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading .modal {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal {
    display: block;
}
    </style>
</head>

<body>

<!-- PAge Loading -->
<div class="fakeLoader"></div>