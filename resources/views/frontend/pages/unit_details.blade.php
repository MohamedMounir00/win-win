
@extends('frontend.layouts.app')
@section('page_title' , trans('frontend.unit_details'))

@section('content')

    @php
        $lang = LaravelLocalization::getCurrentLocale();
    @endphp




    <div class="container">
        <div class="display-page">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-xl-3 col-lg-4">
                        <div class="user-info text-center">
                            @if($unit->realtor->image!=null)
                                <img class="img-fluid img-thumbnail rounded-circle" src="{{url($unit->realtor->image)}}" alt="">
                            @else
                                <img class="img-fluid img-thumbnail rounded-circle" src="https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png" alt="">

                            @endif
                            <h2 style="word-break: break-word;"><a href="{{route('get_profile_view',$unit->user_id)}}">{{$unit->realtor->realtor->company_name}}</a></h2>
                        <!-- <span style="word-break: break-word;">{{$unit->realtor->email}}</span> -->
                            @if($unit->realtor->realtor)

                                <p>{{$unit->realtor->realtor->bio}}</p>

                                <hr>
                                <div class="adress">
                                    <div class="row no-gutters">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="last state">
                                                <span>{{trans('frontend.City')}}</span>
                                                <p>{{unserialize($unit->realtor->city->name)[$lang]}}</p>

                                            </div>

                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class=" state">
                                                <span>{{trans('frontend.State')}}</span>
                                                <p>{{unserialize($unit->realtor->state->name)[$lang]}}</p>

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





                    <div class="col-xl-9 col-lg-8">
                        <div class="container">

                            <div class="latest-units">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="unit-intro-time float-right"> <i class="fa fa-clock-o" aria-hidden="true"></i> {{\Carbon\Carbon::parse($unit->updated_at)->diffForHumans()}}</p>
                                            <p class="unit-intro">{{$unit->title}}</p>

                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <p class="unit-intro-location"> <i class="fa fa-cog" aria-hidden="true"></i> <span>{{unserialize($unit->unit_type->name)[$lang]}}</span></p>
                                            @if($unit->city_id!=null && $unit->state_id!=null)
                                                <p class="unit-intro-location"> <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                                    <span>{{unserialize($unit->city->name)[$lang]}}</span>
                                                </p>
                                            @endif

                                            @if($unit->city_id!=null && $unit->state_id!=null)
                                                <p class="unit-intro-location"> <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                                    <span>{{unserialize($unit->state->name)[$lang]}}</span>
                                                </p>
                                            @endif
                                            @if($unit->status!=null)
                                                <p class="unit-intro-location"> <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                    @if($unit->status=='sale')
                                                        <span>{{trans('frontend.Buy')}}</span>
                                                    @else
                                                        <span>{{trans('frontend.Rent')}}</span>
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>


                                @if($unit->storge->count() > 0)
                                    <div class="row">
                                        <div class="col-md-4 units-galary-title">
                                            <br>
                                            <div class="container">
                                                <h2>{{trans('frontend.Unit_Images')}}</h2>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            @if($unit->price!=null)
                                            <p class="unit-details-price float-right">
                                                <span>{{number_format($unit->price)}} {{trans('frontend.L_E')}}</span>
                                            </p>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="units-galary">
                                        <div class="row no-gutters">
                                            <div class="container">
                                                <div class="col-md-12">

                                                    <div class="show-images">
                                                        @foreach($unit->storge as $item)
                                                            <a  href="{{url($item->url)}}" data-lightbox="image-1"><img class="img-fluid img-thumbnail" src="{{url($item->url)}}" alt=""></a>
                                                        @endforeach

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                                <div class="description">
                                    <div class="container">
                                        <div class="description">
                                            <div class="row no-gutters">
                                                <div class="col-sm-12">
                                                    <h2>{{trans('frontend.Description')}}</h2>
                                                    <p>{{$unit->desc}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <div class="container">
                                    <h2>{{trans('frontend.unit_details')}}</h2>
                                </div>
                                <!-- Statistcs -->
                                <div class="statistics text-center">
                                    <div class="container">
                                        <div class="statt">
                                            <div class="row no-gutters">


                                                @if($unit->finishing!=null)

                                                    <div class="col-xl-3 col-md-6 col-sm-12">
                                                        <div class="state">
                                                            @if($unit->finishing=='yes')
                                                                <span>{{trans('frontend.yes')}}</span>
                                                            @else
                                                                <span>{{trans('frontend.no')}}</span>

                                                            @endif
                                                            <p >{{trans('frontend.Finishing')}} </p>
                                                        </div>
                                                    </div>

                                                @endif


                                                @if($unit->area!=null)

                                                    <div class="col-xl-3 col-md-6 col-sm-12">
                                                        <div class="state">
                                                            <span>{{$unit->area}}</span>
                                                            <p > {{trans('frontend.Area')}}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($unit->floor!=null)

                                                    <div class="col-xl-3 col-md-6 col-sm-12">
                                                        <div class="state">
                                                            <span>{{$unit->floor}}</span>
                                                            <p > {{trans('frontend.Floor')}}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($unit->romms!=null)

                                                    <div class="col-xl-3 col-md-6 col-sm-12">
                                                        <div class="state">
                                                            <span>{{$unit->romms}}</span>
                                                            <p > {{trans('frontend.rooms')}}</p>
                                                        </div>
                                                    </div>
                                                @endif


                                                @if($unit->bathroom!=null)

                                                    <div class="col-xl-3 col-md-6 col-sm-12">
                                                        <div class="state">
                                                            <span>{{$unit->bathroom}}</span>
                                                            <p > {{trans('frontend.bathroom')}}</p>

                                                        </div>
                                                    </div>
                                                @endif






                                                @if($unit->payment_method!=null)

                                                    <div class="col-xl-3 col-md-6 col-sm-12">
                                                        <div class="state">
                                                            @if($unit->payment_method=='cash')
                                                                <span>{{trans('frontend.Cash')}}</span>
                                                            @else
                                                                <span>{{trans('frontend.Instalment')}}</span>

                                                            @endif
                                                            <p > {{trans('frontend.payment_method')}}</p>
                                                        </div>
                                                    </div>
                                                @endif


                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @if($unit->user_id==auth()->user()->id)
                            <!-- Latest Unites -->
                                <div class="action-btn">
                                    <div class="container">
                                        <div class="row no-gutters">
                                            <div class="containEdit">
                                                <a href="{{route('edit-unit',$unit->id)}}" class="btn my-btn edit-button"> <i  class="fa fa-pencil" aria-hidden="true"></i>{{trans('frontend.edit-your-unit')}} </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            @endif
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>


@endsection




