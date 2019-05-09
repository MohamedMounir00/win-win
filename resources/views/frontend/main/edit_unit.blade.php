<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"  dir="{{( app()->getLocale()=='ar')?'rtl':'ltr' }}">
@php

    $lang = LaravelLocalization::getCurrentLocale();

@endphp

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="{{url('frontend/images/logo.png')}}">

    <title>{{trans('frontend.add_unit')}}|win-win</title>


    @if($lang=='ar')
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/main-inside-ar.css">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/lightbox.css">

    @else
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/main-inside-en.css">
        <link rel="stylesheet" href="{{asset('frontend')}}/css/lightbox.css">

    @endif
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/fakeLoader.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/dropify.css">

    <style>
        .transition {
            -webkit-transition: all 3s ease-in-out;
            -moz-transition: all 3s ease-in-out;
            -o-transition: all 3s ease-in-out;
            transition: all 3s ease-in-out;
        }
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

<!-- Page Loading -->
<div class="fakeLoader"></div>

<section class="add-main-info">

    <div class="contain">
        <div class="row no-gutters">
            @include('frontend.main.sidebar')

            <div class="col-xl-9 col-lg-8 col-md-7">
                <div class="info">
                    <div class="container">
                        @if(isset($errors) > 0)
                            @if(Session::has('errors'))

                                <div class="alert alert-danger " >
                                    <ul >
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endif
                        <div class="section-head">
                            <h2>{{trans('frontend.Add_Your_Units')}}</h2>
                            <p> {{trans('frontend.You_must_add_more')}}</p>
                        </div>
                            {!! Form::open(['route'=>['update-unit-out',$unit->id],'method'=>'PUT','class'=>'form-horizontal form-label-left ', 'id' => 'form','files'=>true]) !!}
                            <div class="row">

                                <!-- Upload Images -->
                                <div class="col-xl-6 col-lg-12 col-sm-12">
                                    <div class="upload-image">
                                        <i id="profileImage" class="fa fa-camera" aria-hidden="true"></i>
                                        <input id="imageUpload" type="file" name="image" placeholder="Photo"  capture>
                                        <p>{{trans('frontend.upload_image_unit')}}<span> {{trans('frontend.upload_max')}}</span></p>
                                    </div>
                                </div>

                            <!-- Show All Units {{--route('all-my-unit-page')--}}   -->


                                <!-- Show Images Box -->
                                <div class="col-sm-12">
                                    <div class="show-images transition">
                                        @foreach($unit->storge as $item)
                                            <a  href="{{url($item->url)}}" data-lightbox="image-1"><img class="img-fluid img-thumbnail" src="{{url($item->url)}}"
                                                                                                        alt=""></a>
                                        @endforeach
                                    </div>
                                </div>

                                <!--Select Type -->
                                <div class="col-sm-12">
                                    <div class="form-group transition">
                                        <label> {{trans('frontend.Select_Type')}} </label>
                                        <select  name="type_id" class="form-control " required>
                                            <option value="">{{trans('frontend.select_type')}}</option>

                                            @foreach($type as $t)
                                                <option value="{{$t->id}}" {{ ($unit->type_id == $t->id ? "selected":"") }}>{{unserialize($t->name)[$lang]}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Unit Title -->
                                <div class="col-lg-6 col-sm-12 transition title">
                                    <div class="form-group ">
                                        <label>{{trans('frontend.Title')}}</label>
                                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"  required value="{{$unit->title}}">
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>

                                <!-- Chose Legend -->
                                <div class=" col-sm-12 transition status">
                                    <div class="form-group">
                                        <label>{{trans('frontend.status')}} </label>

                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="radio" id="customCheck1"  name="status" value="sale" {{($unit->status=='sale')?'checked':''}} class="custom-control-input">
                                            <label class="custom-control-label" for="customCheck1"> {{trans('frontend.Buy')}}</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="radio" id="customCheck2" name="status" value="rent" {{($unit->status=='rent')?'checked':''}} class="custom-control-input">
                                            <label class="custom-control-label" for="customCheck2"> {{trans('frontend.Rent')}}</label>
                                        </div>
                                    </div>
                                </div>


                                <!--Select City -->
                                <div class="col-lg-6 col-sm-12 transition city">
                                    <div class="form-group ">

                                        <label>{{trans('frontend.City')}}</label>
                                        <select name="city_id" class="form-control" >
                                            <option value="">{{trans('frontend.select_city')}}</option>
                                            @foreach($city as $c)
                                                <option value="{{$c->id}}"  {{ ($unit->city_id == $c->id ? "selected":"") }}>{{unserialize($c->name)[ $lang]}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!--Select State -->
                                <div class="col-lg-6 col-sm-12 transition state">
                                    <div class="form-group ">

                                        <label>{{trans('frontend.State')}}</label>
                                        <select  name="state_id" class="form-control " >
                                        </select>
                                    </div>
                                </div>


                                <!-- Finishing -->
                                <div class="col-sm-12 transition finishing">
                                    <div class="form-group ">
                                        <label>{{trans('frontend.Finishing')}}</label>
                                        <div class="custom-control  custom-checkbox custom-control-inline">
                                            <input type="radio" id="customRadioInline3" name="finishing"  value="yes" {{($unit->finishing=='yes')?'checked':''}} class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline3">{{trans('frontend.yes')}}</label>

                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="radio" id="customRadioInline4" name="finishing"   value="no" {{($unit->finishing=='no')?'checked':''}} class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline4">{{trans('frontend.no')}}</label>

                                        </div>
                                    </div>
                                </div>


                                <!-- Floor Number -->
                                <div class="col-lg-6 col-sm-12 transition floor">
                                    <div class="form-group ">
                                        <label for="my-input"> {{trans('frontend.Floor')}}</label>
                                        <input min="1" id="my-input" class="form-control" type="number" name="floor" value="{{$unit->floor}}" >
                                    </div>
                                </div>


                                <!-- Number Of Bedrooms -->
                                <div class="col-lg-6 col-sm-12 transition bathroom">
                                    <div class="form-group ">
                                        <label for="my-input">{{trans('frontend.bathroom')}}</label>
                                        <input min="1" id="my-input" class="form-control" type="number"  name="bathroom"  value="{{$unit->bathroom}}" >
                                    </div>
                                </div>



                                <!-- Number of bathroom -->
                                <div class="col-lg-6 col-sm-12 transition rooms">
                                    <div class="form-group ">
                                        <label for="my-input">{{trans('frontend.rooms')}}</label>
                                        <input min="1" id="my-input" class="form-control" type="number"  name="rooms"  value="{{$unit->rooms}}" >
                                    </div>
                                </div>


                                <!-- Area -->
                                <div class="col-lg-6 col-sm-12 transition area">
                                    <div class="form-group ">
                                        <label for="my-input">{{trans('frontend.Area')}}</label>
                                        <input min="1" id="my-input" class="form-control" type="number"   name="area"  value="{{$unit->area}}">
                                    </div>
                                </div>


                                <!-- Price  -->
                                <div class="col-lg-6 col-sm-12 transition price">
                                    <div class="form-group ">
                                        <label for="my-input"> {{trans('frontend.Price')}}</label>
                                        <input min="1" id="my-input" class="form-control" type="number" name="price" value="{{$unit->price}}" >
                                    </div>
                                </div>


                                <!-- payment method -->
                                <div class="col-sm-12 transition payment_method">
                                    <div class="form-group ">
                                        <label>{{trans('frontend.payment_method')}}</label>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="radio" id="customRadioInline5" name="payment_method"   value="cash" {{($unit->payment_method=='cash')?'checked':''}} class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline5">{{trans('frontend.Cash')}}</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="radio" id="customRadioInline6" name="payment_method"  value="installments" {{($unit->payment_method=='installments') ?'checked':''}} class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline6"> {{trans('frontend.Instalment')}}</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12 transition">
                                    <div class="form-group">

                                        <label for="">{{trans('frontend.Description')}}</label>
                                        <textarea name="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" required >{{$unit->desc}}</textarea>
                                        @if ($errors->has('desc'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('desc') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="text-center click-btn">
                                <div class="container">
                                    <button type="submit" class="my-btn btn btn-primary">{{trans('backend.update')}}</button>
                                </div>
                            </div>
                            {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

</section>
<div class="modal"><!-- Place at bottom of page --></div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="{{asset('frontend')}}/js/fakeLoader.min.js"></script>
<script src="{{asset('frontend')}}/js/plugin.js"></script>


<script>
    $body = $("body");

        $(document).on({
            ajaxStart: function() { $body.addClass("loading");    },
             ajaxStop: function() { $body.removeClass("loading"); }    
        });
    $(document).ready(function() {
        

        hideAllInputs();
        var max_photos = 8;
        var current_photos = 0;
        var imageContainer = $('.show-images');
        getInputsByType($('select[name=type_id]').val())
        $('select[name=type_id]').change(function () {
            console.log("hgjg")
            getInputsByType($('select[name=type_id]').val())
        });

        var photosArray = [];
        $("#form").submit( function(e) {


            $('<input />').attr('type', 'hidden')
                .attr('name', "photos")
                .attr('value', photosArray)
                .appendTo('#form');
            return true;
        });

        function upload(img) {


            if (current_photos >= max_photos) {
                return swal("{{trans('frontend.you_can_upload')}}")
            }

            var form_data = new FormData();
            form_data.append('image', img.files[0]);
            form_data.append('_token', '{{csrf_token()}}');

            $.ajax({
                url: "{{route('upload')}}",
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    if (current_photos >= max_photos) {
                        return swal("{{trans('frontend.you_can_upload')}}")
                    }
                    photosArray.push(data.id);
                    imageContainer.fadeIn("slow");
                    $('.show-images').append('<a  href="{{url('')}}/'+data.url+'" data-lightbox="image-1"><img class="img-fluid img-thumbnail" src="{{url('')}}/'+data.url+'" alt=""></a>');
                    current_photos++;
                },
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    swal('' + errors.errors.image);
                }
            });
        }

        function getInputsByType(id) {
            hideAllInputs();
            $.ajax({
                url: "{{url('')}}/get_questions/"+id,
                type: 'GET',
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data)


                    $.each( data.questions, function( key, value ) {
                        $('.' + value.name).css("display", "block");
                        // $('.' + value.name)[1].prop('required',true);
                    });
                }
            });
        }

        $('#imageUpload').change(function () {
            if ($(this).val() != '') {
                upload(this);
            }
        });

        function hideAllInputs() {
            $('.rooms').css("display", "none");
            $('.price').css("display", "none");
            $('.floor').css("display", "none");
            $('.bathroom').css("display", "none");
            $('.area').css("display", "none");
            $('.status').css("display", "none");
            $('.finishing').css("display", "none");
            $('.payment_method').css("display", "none");
            $('.city').css("display", "none");
            $('.state').css("display", "none");
        }

        $('select[name=city_id]').change(function() {
            changeStatusUnit()
        })

        changeStatusUnit()
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
                        var dropdown=$('select[name=state_id]');
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{asset('frontend')}}/js/lightbox.js"></script>
<script type="text/javascript">
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })

</script>
@include('sweet::alert')

</body>

</html>
