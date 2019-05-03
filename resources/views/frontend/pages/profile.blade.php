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
@endsection

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
                        <img class="img-fluid img-thumbnail rounded-circle" src="{{url($user->image)}}" alt="">
                        @else
                            <img class="img-fluid img-thumbnail rounded-circle" src="https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png" alt="">

                        @endif
                        <h2  class="text-truncate">{{$user->name}}</h2>
                        <span class="text-truncate">{{$user->email}}</span>
                            @if($user->realtor)

                            <p>{{$user->realtor->bio}}</p>
                        <hr>
                        <div class="manager-info">
                            <h2>{{trans('frontend.Company_Name')}}</h2>
                            <span>{{$user->realtor->company_name}}</span>
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



                                <div class="container">
                                    @if($user->realtor)

                                    <div class="stars">
                                        <nav style="margin-bottom:30px">
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-rate" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">{{trans('frontend.add_rating')}}</a>
                                                <a class="nav-item nav-link" id="nav-report" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">{{trans('frontend.report')}}</a>
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
                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                {!! Form::open(['route'=>['add_report'],'method'=>'POST', 'id' => 'form','files'=>true]) !!}
                                                    <p class="reportParagraph">{{trans('frontend.send_report')}}</p>
                                                <input name="realtor_id"  value="{{$user->id}}" type="hidden">
                                                    <textarea  name="report" required class="form-control" ></textarea>
                                                    <button class="btn btn-primary my-btn ">{{trans('frontend.send')}}</button>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>

                                        @endif




                                </div>
                            </div>
                        @endif


                        <!-- User Rating box -->
                        
                        <!-- Latest Unites -->
                    </div>
                </div>

                @if($user->realtor)

                <div class="col-xl-3 col-lg-12">
                    <h5 class="contact-heading text-uppercase">{{trans('frontend.Contact_Information')}}</h5>
                    <div class="contact-info">
                        <span>{{trans('frontend.Mobile')}}</span>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-gear"></i> {{$user->phone}}</li>
                            <li><i class="fa fa-gear"></i> {{$user->realtor->phone1}}</li>
                        </ul>
                        <hr>
                        <span> {{trans('frontend.Phone')}}</span>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-gear"></i> {{$user->realtor->phone2}}</li>
                            <li><i class="fa fa-gear"></i> {{$user->realtor->phone3}}</li>
                        </ul>
                        <hr>
                        <span>{{trans('frontend.Street_Address')}}</span>
                        <div class="address">
                            <i class="fa fa-gear"></i>
                            <p class="text-center"> {{$user->realtor->address}} </p>
                        </div>
                    </div>

                    <!-- Latest Rating-->

                    <h5 class="contact-heading text-uppercase my-3">{{trans('frontend.last_rating')}}</h5>
                    <div class="latest-rate">

                    @forelse($rating_10 as $rating)

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
                                <p class="text-truncate">{{$rating->comment}}</p>
                            </div>
                        </div>

                        <hr>
                        @empty
                        {{trans('frontend.no_rating')}}
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

    <section class="homepage-deal">
        <div class="container">
            <div class="row text-center justify-content-md-center">

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="#" class="main">
                        <div data-tilt class="deal-section">
                            <i class="sell-i fa fa-hand-paper-o"></i>
                            <h3> {{trans('frontend.Buy')}}</h3>

                            <p>{{trans('frontend.desc_lorm')}}</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="#" class="main">
                        <div data-tilt class="deal-section">
                            <i class="fa fa-home"></i>
                            <h3> {{trans('frontend.Rent')}}</h3>
                            <p>{{trans('frontend.desc_lorm')}}</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- End Dealing Section -->

@endsection

@section('scripts')


    <script>
        $('#addStar').on('submit',function(e){
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
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

  

    // Function To Get 10 Rating Data From Database 
    function loadMoreData() {
        indicator('start');
        var user_id = {{$user->id}};
        $.ajax({
           url  : "{{url('api/get_all_units')}}",
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

                    console.log(value.date)
                    var html = '<div class="latest-units"> <div class="row no-gutters"> <div class="col-md-3"> <div class="unit-img"> <img class="img-fluid rounded-circle" src="'+value.userimage+'" alt=""> </div> </div> <div class="col-md-6"> <div class="unit-description"> <h2 class="text-truncate"><a class="text-decoration-none" href="'+value.url+'"> '+value.title+'</a></h2> <p>'+value.date+'</p> <span><i class="fa fa-gear"></i> '+value.type+'</span> </div> </div> <div class="col-md-3"> <div class="price"> <span>'+value.price+'</span> <p>'+value.string_prics+'</p> </div> </div> </div></div>';
                  $('#data-container').append(html);
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
});
</script>

@endsection
