@php

    $lang = LaravelLocalization::getCurrentLocale();

@endphp

<div class="top_nav hidden-print">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown" style=" margin-left: 30px">


                    <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><i class="fa fa-language"></i>
                        {{-- <div class="notify"><span class="heartbit"></span><span class="point"></span></div> --}}
                    </a>

                    <ul class="dropdown-menu dropdown-tasks animated slideInUp">



                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>



                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    <img width="20px"  src='{{ url("$localeCode-flag.png") }}' alt="">
                                    {{ $properties['native'] }}
                                </a>



                            </li>
                        @endforeach


                    </ul>

                </li>


            </ul>
        </nav>
    </div>
</div>
