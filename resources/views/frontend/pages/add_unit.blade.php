@extends('frontend.layouts.app')
@section('page_title' , trans('frontend.add_unit'))

@section('content')

    @php

        $lang = LaravelLocalization::getCurrentLocale();

    @endphp


    <!-- Start Introduction Section -->

    <div class="add-new-unit">
        <div class="container">
            @if(isset($errors) > 0)
                @if(Session::has('errors'))

                    <div class="alert alert-danger " >
                        <ul class="list-unstyled" >
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif
            <div class="row no-gutters">
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <span>{{trans('frontend.last_unit')}}</span>
                    @forelse ($last_units  as $unit)
                    <div class="box">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <div class="box-img">
                                        @if(!empty($unit->storge->first()->url))
                                            <img class="img-fluid rounded-circle" src="{{url($unit->storge->first()->url)}}" alt="">
                                        @else
                                            <img class="img-fluid rounded-circle" src="data:image/jpeg;base64,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" alt="">

                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-12">
                                    <div class="box-detail">
                                        <h2 style="word-break: break-word;">{{$unit->title}}</h2>
                                        <p style="word-break: break-word;">{{date('Y-m-d' , strtotime($unit->created_at))}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{route('details',$unit->id)}}" style='color:#FFF;margin-top:20px;' class="btn btn-primary btn-block">{{trans('frontend.details')}}</a>
                    </div>
                    @empty
                        <div class="box">
                            <div class="container">
                                 <p class="nounit">{{trans('frontend.no_unit')}}</p>
                            </div>
                        </div>
             @endforelse



                </div>


                <div class="col-xl-9 col-lg-8 col-md-12">
                    <div class="container">
                        <div class="add-new-info">
                            <div class="section-head">
                                <h2> {{trans('frontend.add-your-unit')}}</h2>
                            </div>
                            {!! Form::open(['route'=>['add-main-main'],'method'=>'POST','class'=>'form-horizontal form-label-left ', 'id' => 'form','files'=>true]) !!}
                            <div class="row">

                                <!-- Upload Images -->
                                <div class="col-xl-6 col-lg-12 col-sm-12">
                                    <div class="upload-image">
                                        <i id="profileImage" class="fa fa-camera" aria-hidden="true"></i>
                                        <input id="imageUpload" type="file" name="image" placeholder="Photo"  capture multiple>
                                        <p>{{trans('frontend.upload_image_unit')}}<span> {{trans('frontend.upload_max')}}</span></p>
                                    </div>
                                </div>

                            <!-- Show All Units {{--route('all-my-unit-page')--}}   -->


                                <!-- Show Images Box -->
                                <div class="col-sm-12">
                                    <div class="show-images transition">


                                    </div>
                                </div>

                                <!--Select Type -->
                                <div class="col-sm-12">
                                    <div class="form-group transition">
                                        <label> {{trans('frontend.Select_Type')}} </label>
                                        <select  name="type_id" class="form-control " required>
                                            <option value="">{{trans('frontend.select_type')}}</option>

                                            @foreach($type as $t)
                                                <option value="{{$t->id}}" {{ (old("type_id") == $t->id ? "selected":"") }}>{{unserialize($t->name)[$lang]}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Unit Title -->
                                <div class="col-lg-6 col-sm-12 transition title">
                                    <div class="form-group ">
                                        <label>{{trans('frontend.Title')}}</label>
                                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"  required value="{{old('title')}}">
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
                                            <input type="radio" id="customCheck1"  name="status" value="sale" class="custom-control-input">
                                            <label class="custom-control-label" for="customCheck1"> {{trans('frontend.Buy')}}</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="radio" id="customCheck2" name="status" value="rent"  class="custom-control-input">
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
                                                <option value="{{$c->id}}"  {{ (old("city_id") == $c->id ? "selected":"") }}>{{unserialize($c->name)[ $lang]}}</option>

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
                                            <input type="radio" id="customRadioInline3" name="finishing"  value="yes" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline3">{{trans('frontend.yes')}}</label>

                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="radio" id="customRadioInline4" name="finishing" value="no" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline4">{{trans('frontend.no')}}</label>

                                        </div>
                                    </div>
                                </div>


                                <!-- Floor Number -->
                                <div class="col-lg-6 col-sm-12 transition floor">
                                    <div class="form-group ">
                                        <label for="my-input"> {{trans('frontend.Floor')}}</label>
                                        <input min="1" id="my-input" class="form-control" type="number" name="floor"  value="{{old('floor')}}">
                                    </div>
                                </div>


                                <!-- Number Of Bedrooms -->
                                <div class="col-lg-6 col-sm-12 transition bathroom">
                                    <div class="form-group ">
                                        <label for="my-input">{{trans('frontend.bathroom')}}</label>
                                        <input min="1" id="my-input" class="form-control" type="number"  name="bathroom" value="{{old('bathroom')}}" >
                                    </div>
                                </div>



                                <!-- Number of bathroom -->
                                <div class="col-lg-6 col-sm-12 transition rooms">
                                    <div class="form-group ">
                                        <label for="my-input">{{trans('frontend.rooms')}}</label>
                                        <input min="1" id="my-input" class="form-control" type="number"  name="rooms" value="{{old('rooms')}}" >
                                    </div>
                                </div>


                                <!-- Area -->
                                <div class="col-lg-6 col-sm-12 transition area">
                                    <div class="form-group ">
                                        <label for="my-input">{{trans('frontend.Area')}}</label>
                                        <input min="1" id="my-input" class="form-control" type="number"   name="area" value="{{old('area')}}">
                                    </div>
                                </div>


                                <!-- Price  -->
                                <div class="col-lg-6 col-sm-12 transition price">
                                    <div class="form-group ">
                                        <label for="my-input"> {{trans('frontend.Price')}}</label>
                                        <input min="1" id="my-input" class="form-control" type="number" name="price" value="{{old('price')}}">
                                    </div>
                                </div>


                                <!-- payment method -->
                                <div class="col-sm-12 transition payment_method">
                                    <div class="form-group ">
                                        <label>{{trans('frontend.payment_method')}}</label>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="radio" id="customRadioInline5" name="payment_method" value="cash" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline5">{{trans('frontend.Cash')}}</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="radio" id="customRadioInline6" name="payment_method" value="installments" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline6"> {{trans('frontend.Instalment')}}</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12 transition">
                                    <div class="form-group">

                                        <label for="">{{trans('frontend.Description')}}</label>
                                        <textarea name="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" required >{{old('desc')}}</textarea>
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
                                    <button type="submit" class="my-btn btn btn-primary">{{trans('frontend.save')}}</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>




            </div>
        </div>
    </div>

    <!-- End Introduction Section -->




@endsection

@section('scripts')



    <script>
        $(document).ready(function() {
          

        
            hideAllInputs();
            var max_photos = 8;
            var current_photos = 0;
            var imageContainer = $('.show-images');
            imageContainer.hide();
            getInputsByType($('select[name=type_id]').val())
            $('select[name=type_id]').change(function () {
                console.log("hgjg")
                getInputsByType($('select[name=type_id]').val())
            });

            var photosArray = [];
            $("#form").submit( function(e) {
                if (current_photos == 0) {
                    swal("{{trans('frontend.validate_image')}}");;
                    e.preventDefault(e);
                }
                

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
                form_data.append('image', img);
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
                    var files = $("#imageUpload")[0].files;
                    for (var i = 0; i < files.length; i++)
                    {
                        upload(files[i]);
                    }
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

    <script type="text/javascript">
        $(document).ready(function() {
            $("#fileuploader").uploadFile({
                url:"http://hayageek.com/examples/jquery/ajax-multiple-file-upload/upload.php",
                fileName:"myfile",
                acceptFiles:"image/*",
                showPreview:true,
                previewHeight: "110px",
                previewWidth: "101px",
            });
        });
    </script>

@endsection
