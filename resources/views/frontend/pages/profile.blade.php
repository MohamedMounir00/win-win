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
                    <div class="container">

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
                                                    <textarea required  name="comment" class="form-control" placeholder="Type Your Comment"></textarea>
                                                    <small>{{trans('frontend.add_rating_comment')}}</small>
                                                    <button class="btn btn-primary my-btn send">Send Your Comment</button>
                                                </form>

                                                <!-- <div class="box-show-comments">
                                                    <div class="container">

                                                    </div>
                                                </div> -->
                                                @else
                                                    <div class="box-show-comments">
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


                        <!-- User Rating box -->


                      @foreach($units as $unit)
                        <div class="latest-units">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <div class="unit-img">

                                        @if(!empty($unit->storge->first()->url))
                                            <img class="img-fluid rounded-circle" src="{{url($unit->storge->first()->url)}}" alt="">
                                        @else
                                            <img class="img-fluid rounded-circle" src="data:image/jpeg;base64,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" alt="">

                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="unit-description">
                                        <h2 class="text-truncate"><a class="text-decoration-none" href="{{route('details',$unit->id)}}"> {{$unit->title}}</a></h2>
                                        <p>{{date('Y-m-d' , strtotime($unit->created_at))}}</p>
                                        <span><i class="fa fa-gear"></i> {{unserialize($unit->unit_type->name)[$lang]}}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="price">
                                        <span>2450 LE</span>
                                        <p>Price</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                     @endforeach
                        <input type="hidden" id="result_no" value="2">
                        <input id="load" type="button" class="btn btn-primary my-btn my-3" value="{{trans('frontend.load_more')}}" />


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

                    @foreach($rating_10 as $rating)

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
                        @endforeach

                        <a class="btn btn-primary my-btn send">{{trans('frontend.load_more')}}</a>
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
                            <h3>Sell</h3>
                            <p>We`ll Stop by to sunggle, feed, any play with your pets in the comfort of their own home</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="#" class="main">
                        <div data-tilt class="deal-section">
                            <i class="fa fa-home"></i>
                            <h3>Rent</h3>
                            <p class="lead">We`ll Stop by to sunggle, feed, any play with your pets in the comfort of their own home</p>
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




<script type="text/javascript">

    $(window).scroll(function() {
        if($(window).scrollTop() == ($(document).height() - $(window).height() - 500.0 )) {
            // ajax call get data from server and append to the div
            alert("asdasdsad")
        }
    });

    $(document).ready(function(){
        $("#load").click(function(){
            loadmore();
        });
    });

    function loadmore()
    {
        var val = document.getElementById("result_no").value;

        $.ajax({
            url: 'https://jsonplaceholder.typicode.com/users',
            type: 'POST',
            data: {
              getresult : val
            },
            success: function(data) {

                $.each(data , function (key, value) {
                    $('.stars').after('<div class"latest-units"><h1>' + value.name + '</h1></div>');
                });

            // We increase the value by 2 because we limit the results by 2
                document.getElementById("result_no").value = Number(val)+2;
            }
        });
    }
</script>

@endsection
