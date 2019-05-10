@extends('frontend.layouts.app')
@section('page_title' , trans('frontend.Public_Rating'))

@section('content')

    @php

        $lang = LaravelLocalization::getCurrentLocale();

    @endphp



    <!-- Start Introduction Section -->

    <div class="user-profile">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-xl-4 col-lg-4">
                    <div class="user-info text-center">
                        @if($user->image!=null)
                        <a  href="{{url($user->image)}}" data-lightbox="image-1">
                        <img class="img-fluid img-thumbnail rounded-circle" src="{{url($user->image)}}" alt=""></a>
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

                <div class="col-xl-8 col-lg-8">
                    <div class="container">
                        
                        <div id ="latest-comment-parent">
                             
                      
                        </div>

                        <input id="load" type="button" class="btn btn-primary my-btn bttn" value="{{trans('frontend.load_more')}}" />

                        <!-- Latest Unites -->



                    </div>
                </div>
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
// Work Function When Load The Page
$(document).ready(function () {
    var offset  = 0;
    loadMoreData();

    // Work Function When Click On Load More Button 
    $('#load').click(function () {
        loadMoreData();
    });

    // Function To Get 10 Rating Data From Database 
    function loadMoreData() {
        var user_id = {{$user->id}};
        $.ajax({
           url  : "{{url('get_all_comment')}}",
           type : 'POST',
           data : {
               offset_id : offset,
               user_id : user_id    
           },
           success : function ( data ) {
                if(data.data.length == 0) {
                    $('#load').hide();
                }
                $.each(data.data ,function(index, value) {
                    console.log(value)
                    var html = ' <div class="latest-units">' +
                            '<div class="container">' +
                                '<div class="row no-gutters">'+
                                    '<div class="col-md-12">'+
                                        '<div class="rating-stars">';
                                        console.log(value.rating_stars)
                                        for (var i = 1; i <= 5; i++) {
                                            if (value.rating_stars >= i) {
                                                html += '<i class="one fa fa-star"></i>';
                                            } else {
                                                html += '<i class="fa fa-star-o"></i>';
                                            }
                                        }
                        html +=         '</div>'+
                                        '<div class="rating-comment">'+
                                            '<p>'+ value.comment +'</p>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
                  $('#latest-comment-parent').append(html);
                        offset ++;
                });
              
           },
           error : function () {
               alert('Error');
           }
        });
    }        
});
</script>
@endsection

