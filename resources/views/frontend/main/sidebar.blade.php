
<div class="col-xl-3 col-lg-4 col-md-5">
        <div class="tolpit">
                <div class="container">
                        <div class="logo">
                                <a href="{{url('/')}}"><img class="img-fluid" src="{{asset('frontend')}}/images/logo2.png" alt=""></a>
                        </div>



                        <ul class="list-unstyled">
                                @if (Auth::check() )
                                        <li><a class="{{Request::path() == "$lang/register"   ? 'active contact-information-page' : ''}} " href="#">{{trans('frontend.Main_Information')}}</a></li>

                                @else
                                        <li><a class="{{Request::path() == "$lang/register"   ? 'active contact-information-page' : ''}} " href="{{ route('register') }}">{{trans('frontend.Main_Information')}}</a></li>

                                @endif

                                @if (Auth::check() && auth()->user()->register=='first_step')


                                        <li><a class="{{Request::path() == "$lang/complete-information-page"   ? 'active contact-information-page' : ''}} " href="{{ route('complete-information-page') }}">{{trans('frontend.Contact_Information')}}</a></li>
                                @elseif(Auth::check() && auth()->user()->register=='second_step')
                                        <li><a class="{{Request::path() == "$lang/complete-information-page"   ? 'active contact-information-page' : ''}} " href="#">{{trans('frontend.Contact_Information')}}</a></li>
                                @else
                                        <li><a class="{{Request::path() == "$lang/complete-information-page"   ? 'active contact-information-page' : ''}} " href="#">{{trans('frontend.Contact_Information')}}</a></li>

                                @endif
                                @if (Auth::check() && auth()->user()->register=='second_step')

                                        <li><a href="{{route('add-unit-page')}}"  class="{{Request::path() == "$lang/add-unit-page"   ? 'active contact-information-page' : ''}} " >{{trans('frontend.Add_Units')}}</a></li>

                                @else
                                        <li><a href="#"  class="{{Request::path() == "$lang/add-unit-page"   ? 'active contact-information-page' : ''}} " >{{trans('frontend.Add_Units')}}</a></li>
                                @endif
                                @if (Auth::check() && auth()->user()->register=='second_step')

                                        <li><a href="{{route('thank-you-page')}}"  class="{{Request::path() == "$lang/thank-you-page"   ? 'active contact-information-page' : ''}} " >{{trans('frontend.Thank_You')}}</a></li>

                                @else
                                        <li><a href="#"  class="{{Request::path() == "$lang/thank-you-page"   ? 'active contact-information-page' : ''}} " >{{trans('frontend.Thank_You')}}</a></li>
                                @endif


                                <li >
                                        @if($lang=='ar')
                                                <a   hreflang="{{ 'en' }}" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">  {{trans('frontend.English')}}</a>
                                        @else
                                                <a  hreflang="{{ 'ar' }}" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">  {{trans('frontend.Arabic')}}</a>
                                        @endif

                                </li>

                        </ul>
                </div>
        </div>
</div>