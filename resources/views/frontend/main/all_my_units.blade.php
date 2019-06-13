<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"  dir="{{( app()->getLocale()=='ar')?'rtl':'ltr' }}">
@php

    $lang = LaravelLocalization::getCurrentLocale();

@endphp

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="{{url('frontend/images/logo.png')}}">

    <title>{{trans('frontend.My_All_Unit')}}|win-win</title>


    @if($lang=='ar')
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/main-inside-ar.css">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/lightbox.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @else
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/main-inside-en.css">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/lightbox.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @endif
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/fakeLoader.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/dropify.css">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/public-css.css">

</head>
<!-- Page Loading -->
<div class="fakeLoader"></div>

<section class="all-main-info">
    <div class="contain">
        <div class="row no-gutters">
            <div class="col-xl-2 ">
                <div class="tolpit">
                    <div class="container">
                        <div class="logo">
                            <a href="{{url('/')}}"><img class="img-fluid" src="{{asset('frontend')}}/images/logo2.png" alt=""></a>
                        </div>

                        <ul class="list-unstyled">
                            @if (Auth::check() )
                                <li><a class="{{Request::path() == "$lang/register"   ? 'active contact-information-page' : ''}} " href="#">{{trans('frontend.Main_Information')}}</a></li>

                            @else
                                <li><a class="{{Request::path() == "$lang/register"   ? 'active contact-information-page' : ''}} " href="{{ route('register') }}">{{trans('frontend.Main_Information')}}</a></li>

                            @endif

                            @if (Auth::check() && auth()->user()->register=='first_step')


                                <li><a class="{{Request::path() == "$lang/complete-information-page"   ? 'active contact-information-page' : ''}} " href="{{ route('complete-information-page') }}">{{trans('frontend.Contact_Information')}}</a></li>
                            @elseif(Auth::check() && auth()->user()->register=='second_step')
                                <li><a class="{{Request::path() == "$lang/complete-information-page"   ? 'active contact-information-page' : ''}} " href="#">{{trans('frontend.Contact_Information')}}</a></li>
                            @else
                                <li><a class="{{Request::path() == "$lang/complete-information-page"   ? 'active contact-information-page' : ''}} " href="#">{{trans('frontend.Contact_Information')}}</a></li>

                            @endif
                            @if (Auth::check() && auth()->user()->register=='second_step')

                                    @if(Request::path() == "$lang/all-my-unit-page")
                                        <li><a href="{{route('add-unit-page')}}"  class="active contact-information-page" >{{trans('frontend.Add_Units')}}</a></li>
                             @else
                                        <li><a href="{{route('add-unit-page')}}"  class="{{Request::path() == "$lang/add-unit-page"   ? 'active contact-information-page' : ''}} " >{{trans('frontend.Add_Units')}}</a></li>

                                    @endif
                            @else
                                <li><a href="#"  class="{{Request::path() == "$lang/add-unit-page"   ? 'active contact-information-page' : ''}} " >{{trans('frontend.Add_Units')}}</a></li>
                            @endif
                            @if (Auth::check() && auth()->user()->register=='second_step')

                                <li><a href="{{route('thank-you-page')}}"  class="{{Request::path() == "$lang/thank-you-page"   ? 'active contact-information-page' : ''}} " >{{trans('frontend.Thank_You')}}</a></li>

                            @else
                                <li><a href="#"  class="{{Request::path() == "$lang/thank-you-page"   ? 'active contact-information-page' : ''}} " >{{trans('frontend.Thank_You')}}</a></li>
                            @endif



                            <li >
                                @if($lang=='ar')
                                    <a   hreflang="{{ 'en' }}" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">  {{trans('frontend.English')}}</a>
                                @else
                                    <a  hreflang="{{ 'ar' }}" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">  {{trans('frontend.Arabic')}}</a>
                                @endif

                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-10">
                <div class="info">
                    <div class="row no-gutters">
                        <div class="col-xl-4 col-lg-3 col-md-12">
                            <div class="navs-section">

                                <!-- Navs Main Title -->
                                <div class="navs-title">
                                    <h2>{{trans('frontend.my_units')}}</h2>
                                </div>
                                <!-- Navs Sub Title -->
                                <div class="navs-subtitle">
                                    <p>{{trans('frontend.list_units')}}</p>
                                </div>
                                <!-- Navs -->
                                @foreach($units as $unit)

                                <div id="{{$unit->id}}" class="content {{$loop->iteration === 1 ? 'active' : '' }} ">
                                    <div class="row">
                                        <div class="col-md-9 col-lg-12 col-xl-9">
                                            <div class="section-content">
                                           <input    type="hidden" value="{{$unit->id}}">
                                                <p>{{$unit->title}}</p>
                                                <h3>{{date('Y-m-d' , strtotime($unit->created_at))}}</h3>
                                                <span><i class="fa fa-cog" aria-hidden="true"></i>
                                                        {{unserialize($unit->unit_type->name)[$lang]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-lg-12 col-xl-3">
                                            <div class="section-img">
                                                @if(!empty($unit->storge->first()->url))
                                                    <img class="img-fluid" src="{{url($unit->storge->first()->url)}}" alt="">
                                                    @else
                                                    <img class="img-fluid" src="data:image/jpeg;base64,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" alt="">

                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>


                        </div>
                        <div class="col-xl-8 col-lg-9 col-md-12">
                            <!-- Datails Section -->
                            <div class="details">
                                <div class="spinner">
                                    <div class="bounce1"></div>
                                    <div class="bounce2"></div>
                                    <div class="bounce3"></div>
                                </div>
                                <!-- Detail Section Header -->
                                <div class="detail-header">
                                    <div class="row no-gutters">
                                        <div class="col-md-8 col-sm-6">
                                            <div class="details-title">
                                                <h2 id="unit_title"> {{trans('frontend.my_units')}}</h2>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="unit-title">
                                                <span id="unit_type"><i class="fa fa-cog" aria-hidden="true"></i>  {{trans('frontend.unit_type')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- User Info Section -->
                                <div class="user-info">
                                    <div class="container">
                                        <div class="row no-gutters">
                                            <div class="col-md-2">
                                                <div class="user-img" >
                                                    <img class="img-fluid" src="https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="user-data">
                                                    <p id="username"></p>
                                                    <h2 id="phone"></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- Units Images -->
                                <div class="units-galary">
                                    <div class="row no-gutters">
                                        <div class="container">
                                            <div class="col-md-12">
                                                <div class="show-images">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Statistcs -->
                                <div class="statistics text-center">
                                    <div class="container">
                                            <div class="row no-gutters">
                                                <div class="col-md-3 statt" id="status">
                                                    <div class="state">
                                                       <span ></span>
                                                        <p >  {{trans('frontend.status')}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 statt" id="city">
                                                    <div class="state">
                                                        <span ></span>
                                                        <p >{{trans('frontend.City')}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 statt" id="state">
                                                    <div class="state">
                                                        <span></span>
                                                        <p >{{trans('frontend.State')}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 statt" id="finishing">
                                                    <div class="state">
                                                        <span> </span>
                                                        <p >{{trans('frontend.Finishing')}} </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 statt" id="area">
                                                    <div class="state">
                                                        <span></span>
                                                        <p > {{trans('frontend.Area')}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 statt" id="floor">
                                                    <div class="state">
                                                        <span></span>
                                                        <p > {{trans('frontend.Floor')}}</p>

                                                    </div>
                                                </div>
                                                <div class="col-md-3 statt" id="rooms">
                                                    <div class="state">
                                                        <span></span>
                                                        <p > {{trans('frontend.rooms')}}</p>

                                                    </div>
                                                </div>
                                                <div class="col-md-3 statt" id="bathroom">
                                                    <div class="state">
                                                        <span></span>
                                                        <p > {{trans('frontend.bathroom')}}</p>

                                                    </div>
                                                </div>
                                                <div class="col-md-3 statt" id="payment_method">
                                                    <div class="state">
                                                        <span></span>
                                                        <p > {{trans('frontend.payment_method')}}</p>

                                                    </div>
                                                </div>
                                                <div class="col-md-3 statt" id="price">
                                                    <div class="state">
                                                        <span></span>
                                                        <p > {{trans('frontend.Price')}}</p>

                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                </div>





                                <!-- Statistcs -->
                                <div class="statistics text-center">
                                    <div class="container">
                                        <div class="statt">
                                            <div class="row no-gutters">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Descripton -->
                                <div class="description">
                                    <div class="container">
                                        <div class="row no-gutters">
                                            <div class="col-sm-12">
                                                <h2>{{trans('frontend.Description')}}</h2>
                                                <p id="desc"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Buttons -->
                                <div class="action-btn">
                                    <div class="container">
                                        <div class="row no-gutters">
                                            <div class="col-sm-12" id="unit-buttons">
                                                {{-- <a id="for-edit-unit" href="{{route('edit-unit-page',$unit->id)}}" class="btn my-btn edit-button"> <i  class="fa fa-pencil" aria-hidden="true"></i>{{trans('frontend.edit-your-unit')}} </a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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


<script>
    // Get All Content From Database
    $(document).ready(function() {
        var unit_id = ""

        // Ajax Request With Loading
        $('.content').click(function (event) {

            var conID = $(this).attr("id");
            console.log(conID)
            $.ajax({

               url: '{{route('all-my-unit')}}',
                method: 'get',
                data: {
                    id : conID
                },
                beforeSend: function () {
                    $('.spinner').show();
                },
                complete: function () {
                    $('.spinner').hide();
                },
                success: function (data) {
                    reciveResponse(data);
                }
            });

        });

        function setTextOrRemove(input_name, value) {
            console.log(value)
            if (value == null) 
                $("#"+input_name).hide();
            else {
                $("#"+input_name).show();
                $("#"+input_name+" span").text(value);
            }
        }

        function reciveResponse(data) {
            $.each(data, function (key, value) {
                // Setting unit data
                unit_id = value.id;
                $("#unit_title").text(value.title);
                $("#unit_type").html('<i class="fa fa-cog" aria-hidden="true"></i> '+value.type);
                if (value.userimage!=null)
                $(".user-img img").attr('src', value.userimage);
                else
                    $(".user-img img").attr('src', 'https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png');

                $("#phone").html(value.phone);
                $("#username").html(value.username);
                $("#desc").text(value.desc);
                setTextOrRemove("city", value.city);
                setTextOrRemove("state", value.state);
                setTextOrRemove("finishing", value.finishing);
                setTextOrRemove("status", value.status);
                setTextOrRemove("floor", value.floor);
                setTextOrRemove("price", value.price);
                setTextOrRemove("area", value.area);
                setTextOrRemove("rooms", value.rooms);
                setTextOrRemove("bathroom", value.bathroom);
                setTextOrRemove("payment_method", value.payment_method);
                // $('#unit-buttons').append('<a id="for-edit-unit" href="'+value.route_update+'" class="btn my-btn edit-button"> <i  class="fa fa-pencil" aria-hidden="true"></i> {{trans("frontend.edit-your-unit")}} </a>');
                

                $('.show-images').empty()
                $('.available-button').remove();
                appendActivationButtons(value);

                // loading all images 
                if (value.storge.length == 0) {
                    $('.units-galary').hide()
                } else {
                    $('.units-galary').show()
                    $.each(value.storge, function (key, value) {
                        $('.show-images').append('<a  href="'+value.url+'" data-lightbox="image-1" data-title="My caption"><img class="img-fluid img-thumbnail" src="'+value.url+'" alt=""></a>');
                    });
                }
                
            });
            
        }


        function changeStatusUnit() {
            var current_status = $('.available-button').attr('id');
            $.ajax({
                url: '{{url('api/change_status_fo')}}',
                method: 'post',
                data: {
                    activation: current_status,
                    id : unit_id
                },
                beforeSend: function () {
                    $('.spinner').show();
                },
                complete: function () {
                    $('.spinner').hide();
                },
                success: function (data) {
                    $('.available-button').remove();
                    appendActivationButtons(data);
                }
            });
        }

        function appendActivationButtons(data) {
            if (data.activation == 'not_active') {
                $('#unit-buttons').prepend('<button class="btn btn-primary available-button" id="active"><i class="fa fa-check" aria-hidden="true"></i>{{trans('backend.active')}}</button>');
            } 
            
            if (data.activation == 'active') {
                $('#unit-buttons').prepend('<button class="btn btn-danger available-button" id="not_active"><i class="fa fa-check" aria-hidden="true"></i> {{trans('backend.not_active')}}</button>');
            } 

            $('.available-button').click(function (event) {
                changeStatusUnit();
            });
        }

        

        $.ajax({
            url: '{{route('all-my-unit')}}',
            method: 'get',

            beforeSend: function () {
                $('.spinner').show();
            },
            complete: function () {
                $('.spinner').hide();
            },
            success: function (data) {
                reciveResponse(data)
            }
        });
    });
</script>
<script src="{{asset('frontend')}}/js/lightbox.js"></script>
<script type="text/javascript">
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })

</script>
</body>

</html>
