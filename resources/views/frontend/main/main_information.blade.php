<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"  dir="{{( app()->getLocale()=='ar')?'rtl':'ltr' }}">
@php

    $lang = LaravelLocalization::getCurrentLocale();
    $city=\App\City::all();
    $state=\App\State::all();

@endphp

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="{{url('frontend/images/logo.png')}}">

    <title>{{trans('frontend.Main_Information')}}|win-win</title>


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
    <link href="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/css/dropify.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/custom.css">

</head>

<body>

<!-- PAge Loading -->
<div class="fakeLoader"></div>

<section class="main-info">
    <div class="contain">
        <div class="row no-gutters">
                @include('frontend.main.sidebar')

            <div class="col-xl-9 col-lg-8 col-md-7">
                <div class="info">
                    <div class="container">
                        <div class="section-head">
                            <h2>{{trans('frontend.tell_about_you')}}</h2>
                        </div>
                        <form method="POST" action="{{ route('register') }}" 
                        aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">


                                <div class="col-lg-6 col-md-12">
                                    <label>{{trans('frontend.user_name')}}</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="off">
                                </div>


                                <div class="col-lg-6 col-md-12">
                                    <label>{{trans('frontend.Company_Name')}}</label>
                                    <input type="text" class="form-control" name="company_name" value="{{ old('company_name') }}" required autocomplete="off">
                                </div>

                                


                                <div class="col-lg-6 col-md-12">
                                    <label>{{trans('frontend.Email')}}</label>
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"  value="{{ old('email') }}" required autocomplete="off">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <div class="col-lg-6 col-md-12">
                                    <label> {{trans('frontend.Password')}} </label>
                                    <input type="password" class="form-control" name="password"  required autocomplete="new-password">
                                </div>


                                <div class="col-lg-6 col-md-12">
                                    <label> {{trans('frontend.Confirm_Password')}}</label>
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation"    required autocomplete="off">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <div class="col-lg-6 col-md-12">

                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3 col-sm-12">
                                            <div class="upload-image">
                                                <input id="profileImage" type="file" name="image" class="dropify"  data-errors-position="outside" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-xl-9 col-lg-9 col-sm-12">
                                            <p> {{trans('frontend.Upload_User_Photo')}}</p>
                                        </div>

                                    </div>




                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label> {{trans('frontend.City')}}</label>
                                    <select name="city_id" class="form-control" required>
                                        <option value="">{{trans('frontend.select_city')}}</option>
                                        @foreach($city as $c)
                                            <option value="{{$c->id}}" >{{unserialize($c->name)[ $lang]}}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12">


                                    <div class="form-group">
                                        <label> {{trans('frontend.State')}}</label>
                                        <select  name="state_id" class="form-control " required>

                                        </select>
                                    </div>


                                </div>
                                <div class="text-center click-btn">
                                    <div class="container">
                                        <button type="submit" class="my-btn btn btn-primary">{{trans('frontend.Next')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

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
</script><script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>

<script>

    $('.dropify').dropify({
        tpl: {
            wrap:            '<div class="dropify-wrapper"></div>',
            loader:          '<div class="dropify-loader"></div>',
            message:         '<div class="dropify-message"><span class="file-icon" /> <p>  {{trans("backend.upload_image")}}  </p></div>',
            preview:         '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">delete</p></div></div></div>',
            filename:        '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
            clearButton:     '<button type="button" class="dropify-clear">delete</button>',
            errorLine:       '<p class="dropify-error"> error</p>',
            errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>'
        }
    });
</script>



<script>
    $(document).ready(function() {
        changeStatusUnit()
        $('select[name=city_id]').change(function() {
            changeStatusUnit()
        })

        function changeStatusUnit() {
            var city = $('select[name=city_id]').val()
            if (city > 0) {
                $.ajax({
                    url: '{{url('api/state_by_id')}}',
                    method: 'post',
                    data: {
                        city_id : city,
                        lang : '{{LaravelLocalization::getCurrentLocale()}}'

                    },
                    beforeSend: function () {
                        $('.spinner').show();
                    },
                    complete: function () {
                        $('.spinner').hide();
                    },
                    success: function (data) {
                        var dropdown = $('select[name=state_id]');
                        dropdown.empty()

                        $.each( data.data, function( key, value ) {
                            dropdown.append($('<option>', {value: value.id,text: value.state}, '</option>'))
                            // $('.' + value.name)[1].prop('required',true);
                        });
                    }
                });
                
            }
        }

    });
</script>
</body>

</html>
