@php
    $users=  App\User::withCount('active_units')->where('verification',1)->whereHas('realtor', function ($q) {})->orderBy('active_units_count','desc')->take(8)->get();
    $lang = LaravelLocalization::getCurrentLocale();

@endphp
<section class="homepage-deal">
    <div class="container">
        <h1 class="font-weight-bold"> {{__('frontend.best_company')}} </h1></br>
        <div class="row text-center">




            @foreach($users as $image)
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">

                    <div class="tile">
                        @if(!Auth::check()||auth()->user()->verification==0)

                        @if($image->image==null)
                            <li><a ><img class="img-thumbnail" src="{{url('frontend/images/profile.jpg')}}" alt=""></a></li>

                        @else
                            <li > <img class="img-thumbnail" src="{{url($image->image)}}" alt=""> </li>


                        @endif

                        @else
                            @if($image->image==null)
                                <li><a href="{{route('get_profile_view',$image->id)}}"><img class="img-thumbnail" src="{{url('frontend/images/profile.jpg')}}" alt=""></a></li>

                            @else
                                <li ><a href="{{route('get_profile_view',$image->id)}}"> <img class="img-thumbnail" src="{{url($image->image)}}" alt=""></a> </li>

                            @endif
                        <div class="text">
                            <a href="{{route('get_profile_view',$image->id)}}" style="color: #FFF;text-decoration: none">
                                <h1 class="animate-text">{{ substr($image->realtor->company_name,0,60)}}</h1>
                                <p class="animate-text">{{$image->phone}}</p>
                                <p class="animate-text">   {{trans('frontend.count_active_unit')}} : <strong>{{$image->active_units_count}}</strong> </p>
                            </a>
                            <a href="{{route('get_profile_view',$image->id)}}" class="dots">
                                <span> </span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>


                </div>

                @endif


            @endforeach

        </div>
    </div>
</section>

