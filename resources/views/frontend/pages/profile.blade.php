@extends('frontend.layouts.app')
@section('styles')

    <style>
        div.stars {
            display: inline-block;
            text-align: center;
            margin: auto;
            width: 100%;
        }

        input.star { display: none; }

        label.star {
            float: right;
            padding:0 5px;
            font-size: 20px;
            color: #444;
            transition: all .2s;
        }

        input.star:checked ~ label.star:before {
            content: '\f005';
            color: #3787E0;
            transition: all .25s;
        }

        input.star-5:checked ~ label.star:before {
            color: #3787E0;
        }

        input.star-1:checked ~ label.star:before { color: #3787E0; }

        label.star:before {
            content: '\f006';
            font-family: FontAwesome;
        }
        .reportParagraph {
            text-align: left;
            color: #9597A6;
            letter-spacing: 1px;
            font-size: 15px;
        }
        #nav-report , #nav-rate {
            color : #3787E0;
        }

    </style>
    <style type="text/css">
        


    </style>
@endsection
@section('page_title' , trans('frontend.profile'))

@section('content')

    @php

        $lang = LaravelLocalization::getCurrentLocale();

    @endphp


    <!-- Start Introduction Section -->
    <div class="user-profile">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-xl-3 col-lg-4">
                    <div class="user-info text-center">
                        @if($user->image!=null)
                        <a  href="{{url($user->image)}}" data-lightbox="image-1">
                        <img class="img-fluid img-thumbnail rounded-circle" src="{{url($user->image)}}" alt=""></a>
                        @else
                            <img class="img-fluid img-thumbnail rounded-circle" src="https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png" alt="">

                        @endif
                        <h2 style="word-wrap:break-word;">{{$user->realtor->company_name}}</h2>
       
                            @if($user->realtor)

                                @if(auth()->user()->id==$user->id)
                                    
                                @endif
                            <p style="word-break: break-word;">{{$user->realtor->bio}}</p>
                        <hr>
                        <div class="manager-info">
                            <h2>{{trans('frontend.name')}}</h2>
                            <span>{{$user->name}}</span>
                        </div>
                        <hr>
                        <div class="adress">
                            <div class="row no-gutters">
                                <div class="col-md-6 col-sm-6">
                                    <div class="last state">
                                        <p>{{unserialize($user->city->name)[$lang]}}</p>
                                        <span>{{trans('frontend.City')}}</span>
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class=" state">
                                        <p>{{unserialize($user->state->name)[$lang]}}</p>
                                        <span>{{trans('frontend.State')}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="site-rating">
                            <span class="titl">{{trans('frontend.reating_site')}}</span>


                            @php
                                $review=(object)['rate'=>$rating_time];
                             for($i=0; $i<5; ++$i){
                             echo '<i class="fa fa-star',($review->rate<=$i?'-o':''),'" aria-hidden="true"></i>';
                             }
                            @endphp
                        </div>
                        <hr>
                        <div class="public-rating">
                            <span class="titl">{{trans('frontend.Public_Rating')}}</span>
                            @php
                                $review=(object)['rate'=>$rating_time_user];
                             for($i=0; $i<5; ++$i){
                             echo '<i class="fa fa-star',($review->rate<=$i?'-o':''),'" aria-hidden="true"></i>';
                             }
                            @endphp
                        </div>
                                @endif
                    </div>
                </div>

                <div class="col-xl-6 col-lg-8">
                    <div id="data-container" class="container">
                        <!-- visitors only can add rating or report -->
                        @if(auth()->user()->id != $user->id)
                            <!-- User Rating box -->
                            <div class="user-rating-box">



                                <div>
                                    @if($user->realtor)

                                    <div class="stars">
                                        <nav style="margin-bottom:30px">
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-rate" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">{{trans('frontend.add_rating')}}</a>
                                                @if(auth()->user()->realtor)

                                                <a class="nav-item nav-link" id="nav-report" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">{{trans('frontend.report')}}</a>
                                                @endif
                                                    <a class="nav-item nav-link" id="nav-report" data-toggle="tab" href="#nav-takemessage" role="tab" aria-controls="nav-profile" aria-selected="false">{{trans('frontend.take_message')}}</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">

                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                @if(auth()->user()->id!=$user->id)
                                                <div class="start">
                                                    @if($ratingcount==0)

                                                    <form class="foodstars" id="addStar" method="POST">
                                                        <input type="hidden" name="realtor_id" value="{{$user->id}}">
                                                        <input class="star star-5" value="5" id="star-5" type="radio" name="star"/>
                                                        <label class="star star-5" for="star-5"></label>
                                                        <input class="star star-4" value="4" id="star-4" type="radio" name="star"/>
                                                        <label class="star star-4" for="star-4"></label>
                                                        <input class="star star-3" value="3" id="star-3" type="radio" name="star"/>
                                                        <label class="star star-3" for="star-3"></label>
                                                        <input class="star star-2" value="2" id="star-2" type="radio" name="star"/>
                                                        <label class="star star-2" for="star-2"></label>
                                                        <input class="star star-1" value="1" id="star-1" type="radio" name="star"/>
                                                        <label class="star star-1" for="star-1"></label>
                                                        <textarea required  name="comment" class="form-control" ></textarea>
                                                        <small class="mysmall">{{trans('frontend.add_rating_comment')}}</small>
                                                        <button class="btn btn-primary my-btn send">{{trans('frontend.send')}}</button>
                                                    </form>

                                                    <!-- <div class="box-show-comments">
                                                        <div class="container">

                                                        </div>
                                                    </div> -->
                                                    @else
                                                        <div class="myBoxx box-show-comments">
                                                            <div class="container">
                                                                @php
                                                                    $review=(object)['rate'=>$ratingme->rating_stars];
                                                                 for($i=0; $i<5; ++$i){
                                                                 echo '<i class="fa fa-star',($review->rate<=$i?'-o':''),'" aria-hidden="true"></i>';
                                                                 }
                                                                @endphp
                                                                <p>{{$ratingme->comment}}</p>
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>
                                                    @endif
                                            </div>
                                            @if(auth()->user()->realtor)
                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                {!! Form::open(['route'=>['add_report'],'method'=>'POST', 'id' => 'form','files'=>true]) !!}
                                                <p class="reportParagraph">{{trans('frontend.send_report')}}</p>
                                                <input name="realtor_id"  value="{{$user->id}}" type="hidden">
                                                <textarea  name="report" required class="form-control" ></textarea>
                                                <button class="btn btn-primary my-btn ">{{trans('frontend.send')}}</button>
                                                {!! Form::close() !!}
                                            </div>
                                            @endif
                                            <div class="tab-pane fade" id="nav-takemessage" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                <p class="reportParagraph">{{trans('frontend.take_message_description')}}</p>
                                                <input  name="report" required class="form-control" />
                                                <button class="btn btn-primary my-btn btn-send" reciver-id="{{$user->id}}">{{trans('frontend.send')}}</button>
                                            </div>
                                        </div>
                                    </div>

                                        @endif




                                </div>
                            </div>
                        @endif


                        <!-- User Rating box -->


         
                    </div>
                    </div>



                    

                @if($user->realtor)

                <div class="col-xl-3 col-lg-12">
                    <h5 class="contact-heading text-uppercase">{{trans('frontend.Contact_Information')}}</h5>
                    <div class="contact-info">
                        <span>{{trans('frontend.Mobile')}}</span>
                        <ul class="list-unstyled">
                            @if($user->phone!=null)
                            <li class="text-break"><i class="fa fa-mobile"></i> {{$user->phone}}</li>
                            @endif
                                @if($user->realtor->phone1!=null)

                                <li class="text-break"><i class="fa fa-mobile"></i> {{$user->realtor->phone1}}</li>
                                @endif

                        </ul>
                        <hr>
                        <span> {{trans('frontend.Phone')}}</span>
                        <ul class="list-unstyled">
                            @if($user->realtor->phone2!=null)

                            <li class="text-break"><i class="fa fa-phone"></i> {{$user->realtor->phone2}}</li>
                            @endif
                                @if($user->realtor->phone3!=null)

                            <li class="text-break"><i class="fa fa-phone"></i> {{$user->realtor->phone3}}</li>
                                @endif
                        </ul>
                        <hr>
                        <span>{{trans('frontend.Email')}}</span>
                        <ul class="list-unstyled">
                            <li style="word-wrap:break-word;" class="text-break"><i class="fa fa-envelope-o"></i> {{$user->email}}</li>
                        </ul>
                        <hr>
                        <span>{{trans('frontend.Street_Address')}}</span>
                        <div class="address">
                            <i class="fa fa-map-marker"></i>
                            <p class="text-center text-break"> {{$user->realtor->address}} </p>
                        </div>
                        
                    </div>
                    <br>

                    <!-- Latest Rating-->

                    <h5 class="contact-heading text-uppercase my-3">{{trans('frontend.last_rating')}}</h5>
                    <div class="latest-rate">

                    @forelse($rating_10 as $rating)
                            <hr>

                        <div class="block">
                            <div class="rate">
                                @php
                                    $review=(object)['rate'=>$rating->rating_stars];
                                 for($i=0; $i<5; ++$i){
                                 echo '<i class="fa fa-star',($review->rate<=$i?'-o':''),'" aria-hidden="true"></i>';
                                 }
                                @endphp
                            </div>
                            <div class="comment">
                                <p style="word-break: break-word;" class="text-truncate">{{$rating->comment}}</p>
                            </div>
                        </div>

                        @empty
                        <span class="when-no-rating">  {{trans('frontend.no_rating')}}</span>
                        @endforelse
                        @if($ratingcount!=0)
                        <a href="{{route('get_all_comment_view',$user->id)}}" class="btn btn-primary my-btn send btn-block">{{trans('frontend.load_more')}}</a>
                        @endif
                     </div>

                   </div>

                        @endif



            </div>
        </div>
    </div>

    <!-- End Introduction Section -->



    <!-- Start Dealing Section -->

    @include('frontend.partials.dealing')


    <!-- End Dealing Section -->

@endsection

@section('scripts')


    <script>
        $('#addStar').on('submit',function(e){
            e.preventDefault();

        
            $.ajax({
                type: 'POST',
                cache: false,
                dataType: 'JSON',
                url: '{{route('rating_user')}}',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.status==false)
                        alert(' لا يمكنك اضافه تقيم')
                    else {
                        var stringStars =   '<div class="myBoxx box-show-comments">' +
                                            '<div class="container">';
                        for (i = 1; i <= 5; i++) {
                            if(data.rating_stars >= i) {
                                stringStars += '<i class="one fa fa-star"></i>';
                            } else{
                                stringStars += '<i class="fa fa-star-o"></i>';
                            }   
                        }
                        stringStars +=      '<p>' + data.comment + '</p>' +
                                            '</div>' +
                                        '</div>';
                        $('#nav-home').append(stringStars);
                        $('.foodstars').hide();

                    }
                }
            });
        });
    </script>





<script>
// Work Function When Load The Page
$(document).ready(function () {
    var offset  = 0;
    loadMoreData();

    // this functions for change status of units
    $('#data-container').on('click', '.available-button', function() {
        changeStatusUnit($(this).attr('activation'), $(this).attr('unit-id'), this)
    });

    function changeStatusUnit(current_status, unit_id, item) {
        $.ajax({
            url: '{{url('api/change_status')}}',
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
                $(item).replaceWith(appendActivationButtons(data.id, data.activation));
                {{--swal('{{trans('frontend.status_changed_successfully')}}')--}}

            }
        });
    }

    function appendActivationButtons(id, activationBtn) {

        if (activationBtn == "active") {
                return  '      <a href="#" class="download available-button active" unit-id="'+id+'" activation="not_active" data-toggle="tooltip" title="{{trans('frontend.not_active_unit')}}">'+
                                                '<i class="fa fa-times"></i>'+
                            '      </a>';
            }

            if (activationBtn == "not_active") {
                 return  '      <a href="#" class="download available-button not_active" unit-id="'+id+'" activation="active" data-toggle="tooltip" title="{{trans('frontend.active_unit')}}">'+
                                                '<i class="fa fa-check"></i>'+
                                '      </a>';
            } 
    }

    // Function To Get 10 Rating Data From Database 
    function loadMoreData() {
        indicator('start');
        var user_id = {{$user->id}};
        $.ajax({
           url  : "{{route('get_all_units')}}",
           type : 'POST',
           data : {

               offset_id : offset,
               user_id : user_id,
               lang : '{{LaravelLocalization::getCurrentLocale()}}'
           },
           success : function ( data ) {
                if(data.data.length == 0) {
                    $('#load').hide();
                }
                $.each(data.data ,function(index, value) {

                    // var imgUrl = value.storge[0].url
                    var imgUrl = '{{url('frontend/images/no-photo.png')}}';
                    if (value.storge.length > 0) {
                        imgUrl = value.storge[0].url
                    } 

                    var html = '<div class="latest-units"> <div class="row no-gutters"> <div class="col-md-3"> <div class="unit-img"> <img class="img-fluid rounded-circle" src="'+imgUrl+'" alt=""> </div> </div> <div class="col-md-6"> <div  class="unit-description"> <h2 style="word-break: break-word;"><a class="text-decoration-none" href="'+value.url+'"> '+value.title+'</a></h2> <p>'+value.date+'</p> <span><i class="fa fa-gear"></i> '+value.type+'</span> <span style="margin-right:40px"><i class="fa fa-map-marker"></i> '+value.type+'</span> </div> </div> <div class="col-md-3"> <div class="price"> <span>'+value.price+'</span> '+appendActivationButtons(value)+'<p>'+value.string_prics+'</p> </div> </div> </div></div>';
                        $('#data-container').append(printUnitCard(value.id, imgUrl, value.type, value.price, value.activation,value.title,value.date,value.url, value.state));
                        offset ++;
                });
                if (data.data.length == 0) {
                    indicator('empty');
                } else {
                    indicator('stop');
                }
                $('[data-toggle="tooltip"]').tooltip();   

           },
           error : function () {
               alert('Error');
                
           }
        });
    }     

    function indicator(status) {

        if (status == 'start') {
            $( "#load" ).remove();
            $('#data-container').append('<img id="loading-icon" src="{{asset('frontend/images/loading.gif')}}" />');
        }

        if (status == 'stop') {
            $('#data-container').append('<input id="load" type="button" class="btn btn-primary my-btn my-3" value="{{trans('frontend.load_more')}}" />');
            $('#loading-icon').remove();

                // Work Function When Click On Load More Button 
            $('#load').click(function () {
                loadMoreData();
            });
        }

        if (status == 'empty') {
            $('#loading-icon').remove();
        }
    }


    $('#nav-takemessage').on('click', '.btn-send', function() {
        var message = $(this).parent().find('input').val();
        var reciver_id = $(this).attr('reciver-id');
        if (message == "") {
            swal('{{trans('frontend.send_message_required')}}')
            return false
        }

        if (typeof reciver_id == 'undefined') {
            swal('{{trans('frontend.chosse_conversation')}}')
            return false
        }

        sendMessage(reciver_id, message);
    });


    // Get ALl Message Ajax
    function sendMessage(receiver, message) {
        $.ajax({
            url: '{{url('/send-message')}}',
            type: 'POST',
            data: {
                receiver_id : receiver,
                message : message,
                lang : '{{LaravelLocalization::getCurrentLocale()}}'
            },
            success: function (value) {
                value = value.data
                if (value.sender_id > 0) {
                    swal('{{trans('frontend.send_success')}}')
                }
                $('#nav-takemessage input').val('');
            }
        });
    }


    // Pring Unit Card Function .......

    function printUnitCard(id, imageUrl, unitType, unitPrice, activationBtn, unitTitle, unitDate, detailsUrl, detailState) {
        var price = ""
        var activation = ""
        if (unitPrice != null) {
            price  = '<label class="price">'+
                '        <span>'+unitPrice+'</span>'+
                '      </label>';
        }
        if (unitTitle != null) {
            unitTitle = unitTitle.slice(0, 100)
        }
        if (activationBtn != null) {
           activation = appendActivationButtons(id, activationBtn)
            
        }
        return '<div class="food">'+
'    <div class="cover" style="background-image: url('+imageUrl+')">'+
'      <label>'+
'        <span>'+unitType+'</span>'+
'      </label>'+
      price +
'      <label class="right">'+
'        <span>'+detailState+'</span>'+
'      </label>'+
    activation+
'    </div>'+
'    <div class="info">'+
'      <a href="'+detailsUrl+'" class="recipe">'+
'        <i class="fa fa-info-circle">'+

'        </i>'+
'        <span>{{trans('frontend.details')}}</span>'+
'      </a>'+
'      <div class="contentt">'+
'            <div class="container">'+
'                <div class="row">'+
'                    '+
'                    <div class="col-md-9 col-sm-9">'+
'                        <div class="date">'+
'                            <span class="date-string">'+unitTitle+'</span>'+
'                            <span class="date-num">'+unitDate+'</span>'+
'                        </div>'+
''+
'                        '+
'                    </div>'+
'                </div>'+
'            </div>'+
'      </div>'+
'    </div>'+
'  </div>';
    }
});
</script>


@endsection
