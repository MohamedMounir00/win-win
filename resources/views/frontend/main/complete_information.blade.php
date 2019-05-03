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
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/main-inside-ar.css">
    @else
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/main-inside-en.css">

    @endif
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/fakeLoader.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/dropify.css">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/custom.css">
</head>
<body>

<!-- Page Loading -->
<div class="fakeLoader"></div>


<section class="complete-info">

    <div class="row no-gutters">
        @include('frontend.main.sidebar')

        <div class="col-xl-9 col-lg-7 col-md-7">
            <div class="info">
                <div class="container">
                    <div class="section-head">
                        <h2>{{trans('frontend.complete')}}</h2>
                        <p>{{trans('frontend.right_way')}} .</p>
                    </div>
                    {!! Form::open(['route'=>['complete-information'],'method'=>'PUT','files'=>true,'autocomplete'=>'off']) !!}
                        <div class="form-row no-gutters">
                            <div class="col-lg-6 col-md-12">
                                <label>{{trans('frontend.Phone')}}</label>
                                <input type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"  value="{{ old('phone') }}"name="phone" >
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label> {{trans('frontend.Mobile_number')}}</label>
                                <input type="tel" class="form-control{{ $errors->has('phone1') ? ' is-invalid' : '' }}"  value="{{ old('phone1') }}"name="phone1" >
                                @if ($errors->has('phone1'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone1') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label>{{trans('frontend.Phone')}}</label>
                                <input type="tel" class="form-control{{ $errors->has('phone2') ? ' is-invalid' : '' }}"  value="{{ old('phone2') }}" name="phone2">
                                @if ($errors->has('phone2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone2') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label> {{trans('frontend.Mobile_number')}}</label>
                                <input type="tel" class="form-control{{ $errors->has('phone3') ? ' is-invalid' : '' }}"  value="{{ old('phone3') }}" name="phone3"  >
                                @if ($errors->has('phone3'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone3') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <label> {{trans('frontend.Street_Address')}}</label>
                                <input type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"  value="{{ old('address') }}" name="address" >
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label> {{trans('frontend.Company_Bio')}}</label>
                                    <textarea class="form-control {{ $errors->has('bio') ? ' is-invalid' : '' }}" name="bio" value="{{ old('bio') }}"  maxlength="200"></textarea>
                                    @if ($errors->has('bio'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bio') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="click-btn">
                            <div class="container">
                                <button type="submit" class="my-btn btn btn-primary">{{trans('frontend.Next')}}</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

</section>

<script src="https://code.jquery.com/jquery-3.1.1.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="{{asset('frontend')}}/js/fakeLoader.min.js"></script>
<script src="{{asset('frontend')}}/js/plugin.js"></script>

</body>

</html>
