@php

    $lang = LaravelLocalization::getCurrentLocale();

@endphp
<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{url('/home')}}">
                <img src="{{asset('frontend')}}/images/logooo.png" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>


            <!-- Navbar Lists -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar Lists -->
                <ul class="navbar-nav ml-auto">
                    @if(Auth::check())


                        <li class="nav-item dropdown">
                            <a class="nav-link last dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{auth()->user()->name}}
                                @if(auth()->user()->image==null)
                                    <img class='img-fluid user-profile-img' src="https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png" alt="">

                                @else
                                    <img class='img-fluid user-profile-img' src="{{url(auth()->user()->image)}}" alt="">

                                @endif
                            </a>
                            

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if(auth()->user()->realtor)

                                <a class="dropdown-item" href="{{route('get_profile_view',auth()->user()->id)}}">{{trans('frontend.profile')}}</a>
                                <a class="dropdown-item" href="{{route('edit_profile')}}">{{trans('frontend.edit_profile')}}</a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ trans('frontend.logout')}}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>


                            </div>
                        </li>

                        <li class="nav-item active">
                            <a href="{{route('chat')}}" class="badge1" data-badge="{{\App\Helper\Helper::count_unseen_message() > 9 ? '9+' : \App\Helper\Helper::count_unseen_message()}}"> <img src="{{url('frontend/images/chatting.png')}} " style="width: 30px"></a>
                        </li>




                    @else
                        <li class="nav-item active">
                            <a class="nav-link " href="{{route('login')}}">{{trans('frontend.login')}}</a>
                        </li>
                        
                    @endif
                      @if(auth()->user()->admins)
                            <li class="nav-item active">
                                <a class="nav-link " href="{{route('admin')}}">{{trans('frontend.admin-panel')}}</a>
                            </li>
                                  @endif


                    <li class="nav-item active">
                        @if($lang=='ar')
                            <a class="nav-link last"  hreflang="{{ 'en' }}" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"> English</a>
                        @else
                            <a class="nav-link last"  hreflang="{{ 'ar' }}" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"> العربيه</a>
                        @endif

                    </li>
                        @if(auth()->user()->realtor)


                        <li class="nav-item active">
                            <a class="nav-link last add-unit-link " href="{{route('get_data_view')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{trans('frontend.add_unit')}}</a>
                        </li>
                        @endif



                </ul>
            </div>
        </div>
    </nav>
</header>
