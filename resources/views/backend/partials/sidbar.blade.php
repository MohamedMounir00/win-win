<div class="col-md-3 left_col hidden-print">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"> <span>
                   @if(app()->getLocale()=='ar' )

                        win-win لوحه تحكم
                    @else
                        win-win AdminPanel
                    @endif
                </span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">

            <div class="profile_info">
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">

                    <li><a><i class="fa fa-edit"></i> {{trans('backend.admins_controller')}} <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admins.index')}}">{{trans('backend.admins')}} </a></li>

                            <li><a href="{{route('admins.create')}}">{{trans('backend.create')}} </a></li>

                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i> {{trans('backend.realtor_controller')}} <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('realtor.index')}}">{{trans('backend.realtor')}} </a></li>


                        </ul>
                    </li>

                    <li><a><i class="fa fa-edit"></i> {{trans('backend.unit_controller')}} <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('unit.index')}}">{{trans('backend.all_unit')}} </a></li>
                            <li>
                                <a href="{{route('unit_not_active')}}">{{trans('backend.unit_not_active')}}
                                    <span class="label label-danger pull-left">{{\App\Helper\Helper::count_unit_not_active()}}</span>
                                </a></li>


                        </ul>
                    </li>

                    <li><a><i class="fa fa-edit"></i> {{trans('backend.type_unit_controller')}} <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('type_unit.index')}}">{{trans('backend.type_unit')}} </a></li>

                            <li><a href="{{route('type_unit.create')}}">{{trans('backend.create')}} </a></li>

                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i> {{trans('backend.cities')}} <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('cities.index')}}">{{trans('backend.cities')}} </a></li>

                            <li><a href="{{route('cities.create')}}">{{trans('backend.create')}} </a></li>

                        </ul>
                    </li>

                    <li><a><i class="fa fa-edit"></i> {{trans('backend.state_controller')}} <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('state.index')}}">{{trans('backend.states')}} </a></li>

                            <li><a href="{{route('state.create')}}">{{trans('backend.create')}} </a></li>

                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i> {{trans('backend.get_settings')}} <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('get_settings')}}">{{trans('backend.get_settingsr_controller')}} </a></li>


                        </ul>
                    </li>

                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">

            <a data-toggle="tooltip" data-placement="top" title="{{trans('backend.full')}}" onclick="toggleFullScreen();">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="{{trans('backend.close')}}" class="lock_btn">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="{{trans('backend.logout')}}" href="{{ route('logout') }}"     onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>

