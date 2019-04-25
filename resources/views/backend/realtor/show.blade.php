@extends('backend.layouts.app')
@section('styles')
    <style>
        div.stars {
            width: 270px;
            display: inline-block;
        }

        input.star { display: none; }

        label.star {
            float: right;
            padding: 10px;
            font-size: 36px;
            color: #444;
            transition: all .2s;
        }

        input.star:checked ~ label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }

        input.star-5:checked ~ label.star:before {
            color: #FE7;
            text-shadow: 0 0 20px #952;
        }

        input.star-1:checked ~ label.star:before { color: #F62; }

        label.star:hover { transform: rotate(-15deg) scale(1.3); }

        label.star:before {
            content: '\f006';
            font-family: FontAwesome;
        }
    </style>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

@endsection
@section('content')
    @php
        $lang= Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale()



    @endphp

    <div class="x_panel">
        <div class="x_title">
            <h2>{{trans('backend.profile')}}

            </h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                <div class="profile_img">
                    <div id="crop-avatar">
                        <!-- Current avatar -->
                        @if($user->image!=null)

                            <img class="img-responsive avatar-view"
                                 src="{{url($user->image)}}"


                                 alt="Avatar"
                                 title="Change the avatar">
                        @else
                            <img class="img-responsive avatar-view"
                                 src="https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png"


                                 alt="Avatar"
                                 title="Change the avatar">
                        @endif
                    </div>
                </div>
                <h3>{{$user->name}}</h3>

                <ul class="list-unstyled user_data">
                    <li><i class="fa fa-envelope user-profile-icon"></i>
                        {{$user->email}}

                    </li>

                    <li>
                        <i class="fa fa-briefcase user-profile-icon"></i>
                        {{trans('backend.company_name')}}
                        {{ $user->realtor->company_name}}

                    </li>

                    <li class="m-top-xs">
                        <i class="fa fa-mobile user-profile-icon"></i>
                        {{$user->phone}}
                    </li>


                    <li class="m-top-xs">
                        <i class="fa fa-mobile user-profile-icon"></i>
                        {{$user->realtor->phone1}}
                    </li>
                    <li class="m-top-xs">
                        <i class="fa fa-mobile user-profile-icon"></i>
                        {{$user->realtor->phone2}}
                    </li>
                    <li class="m-top-xs">
                        <i class="fa fa-mobile user-profile-icon"></i>
                        {{$user->realtor->phone3}}
                    </li>

                </ul>

                <a href="{{route('realtor.edit', $user->id)}}" class="btn btn-success"><i
                            class="fa fa-edit m-right-xs"></i>&nbsp;{{trans('backend.update')}}</a>
                <a href="{{route('realtor.index')}}" class="btn btn-primary">{{trans('backend.back')}}</a>

                <br/>


            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">

                <div class="profile_title">
                    <div class="col-md-6">
                        <h2>{{$user->name}}</h2>
                    </div>

                </div>
                <!-- start of user-activity-graph -->
                <div id="graph_bar" style="width:100%; height:280px;">

                    <p class="lead">
                        {{$user->realtor->bio}}
                    </p>

                </div>
                <br>

                <!-- end of user-activity-graph -->
                <div class="clearfix"></div>
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab"
                                                                  role="tab" data-toggle="tab"
                                                                  aria-expanded="true">{{trans('backend.count_units')}}</a>
                        </li>

                        <li role="presentation" class=""><a href="#tab_content3" role="tab"
                                                            id="profile-tab2" data-toggle="tab"
                                                            aria-expanded="false">{{trans('backend.profile')}}</a>
                        </li>

                        <li role="presentation" class=""><a href="#tab_content4" role="tab"
                                                            id="profile-tab2" data-toggle="tab"
                                                            aria-expanded="false">{{trans('backend.rating')}}</a>
                        </li>


                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                             aria-labelledby="home-tab">


                            <a  href="{{route('get_unit_user_view',[$user->id,'active'])}}" class="btn btn-app">
                                <span class="badge bg-red">{{$unit_active_count}}</span>
                                {{trans('backend.unit_active_count')}}
                            </a>

                            <a  href="{{route('get_unit_user_view',[$user->id,'not_active'])}}" class="btn btn-app">
                                <span class="badge bg-red">{{$unit_not_active_count}}</span>
                                {{trans('backend.unit_not_active_count')}}
                            </a>


                            <!-- end recent activity -->

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab_content4"
                             aria-labelledby="home-tab">





                            <div class="stars">
                                <label class=""> اضف تقيم</label>

                                <form class="foodstars" action="{{route('rating')}}" id="addStar" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="realtor_id" value="{{ $user->id }}">

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
                                </form>
                            </div>
                                                    <!-- end recent activity -->
                            <div class="row">
                                <div class=" col-md-6 col-sm-6 col-xs-12  pull-left">
                                <label class=""> {{trans('backend.rating_admin')}}</label>
                                <div>
                                @php
                                    $review=(object)['rate'=>$rating_time];
                                 for($i=0; $i<5; ++$i){
                                 echo '<i class="fa fa-star',($review->rate<=$i?'-o':''),'" aria-hidden="true"></i>';
                                 }
                                @endphp
                                </div>
                                </div>

                                <div  class="col-md-6 col-sm-6 col-xs-12  pull-right">
                                    <label class=""> التقيم العام للمستخدمين</label>
                                 <div>
                                    @php
                                        $review=(object)['rate'=>$rating_time_user];
                                     for($i=0; $i<5; ++$i){
                                     echo '<i class="fa fa-star',($review->rate<=$i?'-o ':''),'" aria-hidden="true"></i>';
                                     }
                                    @endphp
                            </div>
                                </div>
                            </div>

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab_content3"
                             aria-labelledby="profile-tab">

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="">{{trans('backend.name')}} <span
                                    >*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="name" required
                                           class="form-control col-md-7 col-xs-12" value="{{$user->name}}" disabled>

                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="">{{trans('backend.email')}} <span
                                    >*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" id="first-name" name="email" required
                                           class="form-control col-md-7 col-xs-12" value="{{$user->email}}"
                                           autocomplete="new_email" disabled>

                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <br>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="">{{trans('backend.phone')}} <span
                                    >*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="first-name" name="phone" required
                                           class="form-control col-md-7 col-xs-12" value="{{$user->phone}}" disabled>

                                </div>
                            </div>

                            <div class="clearfix"></div>


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $('#addStar').change('.star', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                type: 'POST',
                cache: false,
                dataType: 'JSON',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(data) {
                    console.log(data);
                }
            });
        });
</script>

@endsection
