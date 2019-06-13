@extends('frontend.layouts.app')
@section('page_title' , trans('frontend.edit-your-unit'))

@section('content')

    @php

        $lang = LaravelLocalization::getCurrentLocale();

    @endphp


    <!-- Start Introduction Section -->

    <div class="add-new-unit">
        <div class="container">
            @if(isset($errors) > 0)
                @if(Session::has('errors'))

                    <div class="alert alert-danger" >
                        <ul >
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif
            <div class="row no-gutters">


                <div class="col-md-12">
                    <div class="container">
                        <div class="add-new-info">
                            <div class="section-head">
                                <h2> {{trans('frontend.edit-your-unit')}}</h2>
                            </div>
                            {!! Form::open(['route'=>['update-unit',$unit->id],'method'=>'PUT','class'=>'form-horizontal form-label-left ', 'id' => 'form','files'=>true]) !!}
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
                                        <div class="row">
                                        @foreach($unit->storge as $item)
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <a  href="{{url($item->url)}}" data-lightbox="image-1"><img class="img-fluid img-thumbnail boxImg" src="{{url($item->url)}}" alt=""></a>
                                                <button id="remove_photo" class="btn btn-danger" image-id="{{$item->id}}"><i class="fa fa-close"></i></button>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!--Select Type -->
                                <div class="col-sm-6">
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
                                        <select name="floor" class="form-control" >

                                            @foreach(\App\Helper\Helper::floor() as $c)
                                                <option value="{{$c}}"  {{ ($unit->floor == $c ? "selected":"") }}>{{$c}}</option>


                                            @endforeach
                                        </select>
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

    <!-- End Introduction Section -->




@endsection

@section('scripts')



    <script>
        $(document).ready(function() {

            hideAllInputs();
            var old_photos = '{{$unit->storge->count()}}';
            var max_photos = 8;
            var current_photos = 0;
            var imageContainer = $('.show-images');
            getInputsByType($('select[name=type_id]').val())

            $('select[name=type_id]').change(function () {
                console.log("hgjg")
                getInputsByType($('select[name=type_id]').val())
            });

            var photosArray = [];
            var deletedphotosArray = [];

            $("#form").submit( function(e) {
                if (checkPhotosCount() > 8) 
                    e.preventDefault(e);
    
                $('<input />').attr('type', 'hidden')
                    .attr('name', "photos")
                    .attr('value', photosArray)
                    .appendTo('#form');

                $('<input />').attr('type', 'hidden')
                    .attr('name', "photos_remove")
                    .attr('value', deletedphotosArray)
                    .appendTo('#form');

                return true;
            });

            $('.show-images').on('click', '#remove_photo',function() {
                deletedphotosArray.push($(this).attr('image-id'))
              //  alert(deletedphotosArray)
                var $target = $(this).parent();
                $target.hide('slow', function(){ $target.remove(); });
                checkImages()
                return false;
            });

            function checkPhotosCount() {
                return ((parseInt(old_photos) + current_photos) - deletedphotosArray.length)
            }

            function upload(img) {
                if (current_photos >= max_photos) {
                    return swal("{{trans('frontend.you_can_upload')}}")
                }
                console.log(checkPhotosCount());
                if (checkPhotosCount() >= 8)
                    return swal('{{trans('frontend.you_can_upload_image_more')}}');

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
                        if (current_photos >= max_photos) 
                            return swal("{{trans('frontend.you_can_upload')}}")

                        if (checkPhotosCount() >= 8)
                            return swal('{{trans('frontend.you_can_upload_image_more')}}');
                        photosArray.push(data.id);
                        imageContainer.fadeIn("slow");
                        $('.show-images').children().append('<div class="col-sm-6 col-md-4 col-lg-3"><a  href="{{url('')}}/'+data.url+'" data-lightbox="image-1"><img class="img-fluid img-thumbnail" src="{{url('')}}/'+data.url+'" alt=""><button id="remove_photo" class="btn btn-danger" image-id="'+data.id+'"><i class="fa fa-close"></i></button></a></div>');
                        current_photos++;
                        checkImages()
                    },
                    error: function(data) {
                        var errors = $.parseJSON(data.responseText);
                        swal('' + errors.errors.image);

                    }
                });
            }

            function checkImages() {
                if (((parseInt(old_photos) + current_photos) - deletedphotosArray.length) <= 0) {
                    $('.show-images').fadeOut('slow')
                } else {
                    $('.show-images').fadeIn('slow')
                }
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
