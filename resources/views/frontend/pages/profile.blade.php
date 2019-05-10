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
                                stringStars += '<i class="fa fa-star"></i>';
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
                $(item).replaceWith(appendActivationButtons(data));
                {{--swal('{{trans('frontend.status_changed_successfully')}}')--}}

            }
        });
    }

    function appendActivationButtons(data) {

        if (data.activation == 'not_active') {
            return '<button class="btn btn-primary available-button"activation="active"  unit-id="'+data.id+'"><i class="fa fa-check" aria-hidden="true"></i>{{trans('backend.active')}}</button>';
        } 
        
        if (data.activation == 'active') {
            return '<button class="btn btn-danger available-button" activation="not_active" unit-id="'+data.id+'"><i class="fa fa-check" aria-hidden="true"></i> {{trans('backend.not_active')}}</button>';
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
                    var imgUrl = '{{asset('no-photo.png')}}';
                    if (value.storge.length > 0) {
                        imgUrl = value.storge[0].url
                    } 

                    var html = '<div class="latest-units"> <div class="row no-gutters"> <div class="col-md-3"> <div class="unit-img"> <img class="img-fluid rounded-circle" src="'+imgUrl+'" alt=""> </div> </div> <div class="col-md-6"> <div  class="unit-description"> <h2 style="word-break: break-word;"><a class="text-decoration-none" href="'+value.url+'"> '+value.title+'</a></h2> <p>'+value.date+'</p> <span><i class="fa fa-gear"></i> '+value.type+'</span> <span style="margin-right:40px"><i class="fa fa-map-marker"></i> '+value.type+'</span> </div> </div> <div class="col-md-3"> <div class="price"> <span>'+value.price+'</span> '+appendActivationButtons(value)+'<p>'+value.string_prics+'</p> </div> </div> </div></div>';
                        $('#data-container').append(printUnitCard(imgUrl, value.type, value.price, value.activation,value.title,value.date,value.url, value.state));
                        offset ++;
                });
                if (data.data.length == 0) {
                    indicator('empty');
                } else {
                    indicator('stop');
                }
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

    function printUnitCard(imageUrl, unitType, unitPrice, activationBtn, unitTitle, unitDate, detailsUrl, detailState) {
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
            if (activationBtn == "active") {
                activation =    '      <a href="#" class="download">'+
                            '		          <a href="#" class="download">'+
       ' <svg x="0px" y="0px" width="27px" height="22px">'+
	      '  <g>'+
		        '<path d="M 12.5625 0 C 12.0102 0 11.5625 0.4477 11.5625 1 L 11.565 8.69 L 9.0625 8.6875 L 12 16 L 14 16 L 17.0625 8.6875 L 14.5 8.69 L 14.5 1 C 14.5 0.4477 14.0523 0 13.5 0 L 12.5625 0 ZM 1 19 L 1 14 L 0 14 L 0 19 C 0 20.6569 1.3431 22 3 22 L 24 22 C 25.6569 22 27 20.6569 27 19 L 27 14 L 26 14 L 26 19 C 26 20.1046 25.1046 21 24 21 L 3 21 C 1.8954 21 1 20.1046 1 19 Z" fill="#ffffff"/>'+
	       ' </g>'+
       ' </svg>'+
      '</a>'+
                            '      </a>';
            }

            if (activationBtn == "not_active") {
                activation =    '      <a href="#" class="download">'+
                            '		         <a href="#" class="download">'+
       ' <svg x="0px" y="0px" width="27px" height="22px">'+
	      '  <g>'+
		        '<path d="M 12.5625 0 C 12.0102 0 11.5625 0.4477 11.5625 1 L 11.565 8.69 L 9.0625 8.6875 L 12 16 L 14 16 L 17.0625 8.6875 L 14.5 8.69 L 14.5 1 C 14.5 0.4477 14.0523 0 13.5 0 L 12.5625 0 ZM 1 19 L 1 14 L 0 14 L 0 19 C 0 20.6569 1.3431 22 3 22 L 24 22 C 25.6569 22 27 20.6569 27 19 L 27 14 L 26 14 L 26 19 C 26 20.1046 25.1046 21 24 21 L 3 21 C 1.8954 21 1 20.1046 1 19 Z" fill="#ffffff"/>'+
	       ' </g>'+
       ' </svg>'+
      '</a>'+
                            '      </a>';
            }
            
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
'        <i>'+
'          <svg x="0px" y="0px" width="26px" height="28px"'+
'>'+
'	          <g>'+
'		          <path d="M 8.5 20 L 8.5 21 L 17.5 21 L 17.5 20 L 8.5 20 ZM 8.5 16 L 8.5 17 L 17.5 17 L 17.5 16 L 8.5 16 ZM 8.5 12 L 8.5 13 L 17.5 13 L 17.5 12 L 8.5 12 ZM 20 0 C 19.4477 0 19 0.4477 19 1 L 19 6 C 19 6.5523 19.4477 7 20 7 C 20.5523 7 21 6.5523 21 6 L 21 1 C 21 0.4477 20.5523 0 20 0 ZM 13 0 C 12.4477 0 12 0.4477 12 1 L 12 6 C 12 6.5523 12.4477 7 13 7 C 13.5523 7 14 6.5523 14 6 L 14 1 C 14 0.4477 13.5523 0 13 0 ZM 6 0 C 5.4477 0 5 0.4477 5 1 L 5 6 C 5 6.5523 5.4477 7 6 7 C 6.5523 7 7 6.5523 7 6 L 7 1 C 7 0.4477 6.5523 0 6 0 ZM 15 4 L 18 4 L 18 3 L 15 3 L 15 4 ZM 8 4 L 11 4 L 11 3 L 8 3 L 8 4 ZM 3 4 L 4 4 L 4 3 L 3 3 C 1.3431 3 0 4.3431 0 6 L 0 25 C 0 26.6569 1.3431 28 3 28 L 23 28 C 24.6569 28 26 26.6569 26 25 L 26 6 C 26 4.3431 24.6569 3 23 3 L 22 3 L 22 4 L 23 4 C 24.1046 4 25 4.8954 25 6 L 25 25 C 25 26.1046 24.1046 27 23 27 L 3 27 C 1.8954 27 1 26.1046 1 25 L 1 6 C 1 4.8954 1.8954 4 3 4 Z" fill="#ffffff"/>'+
'	          </g>'+
'          </svg>'+
'        </i>'+
'        <span>التفاصيل</span>'+
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
