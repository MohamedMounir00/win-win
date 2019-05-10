@extends('backend.layouts.app')
@section('page_title' , trans('backend.home'))

@section('content')
    <!-- page content -->
        <div class="">
            <div class="row top_tiles">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                        <div class="count">{{$units_active_count}}</div>
                        <h3>  {{trans('backend.units_active_count')}} </h3>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-comments-o"></i></div>
                        <div class="count">{{$units_Notactive_count}}</div>
                        <h3> {{trans('backend.units_Notactive_count')}}</h3>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                        <div class="count">{{$user_active_count}}</div>
                        <h3> {{trans('backend.user_active_count')}}</h3>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-check-square-o"></i></div>
                        <div class="count">{{$user_Notactive_count}}</div>
                        <h3> {{trans('backend.user_Notactive_count')}}</h3>
                    </div>
                </div>
            </div>



<div class="row">
    <div class="col-md-12">
        <div class="x_panel" >

            <div class="x_content">
                <div class="col-md-9 col-sm-12 col-xs-12">

                    <div class="tiles">
                        <div class="col-md-6 tile">
                            <span>{{trans('backend.max_price')}}</span>
                            <h2>{{$units_max}} {{trans('backend.currency')}}</h2>
                            <span class="sparkline22 graph" style="height: 160px;"><canvas width="198" height="40" style="display: inline-block; width: 198px; height: 40px; vertical-align: top;"></canvas></span>
                        </div>
                        <div class="col-md-6 tile">
                            <span>{{trans('backend.min_price')}}</span>
                            <h2>{{$units_min}} {{trans('backend.currency')}}</h2>
                            <span class="sparkline22 graph" style="height: 160px;"><canvas width="200" height="40" style="display: inline-block; width: 200px; height: 40px; vertical-align: top;"></canvas></span>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

            <div class="row">
                <div class="col-md-4">
                    <div class="x_panel"style="min-height:510px;">
                        <div class="x_title">
                            <h2>
                                {{trans('backend.lastclient')}}
                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <ul class="list-unstyled top_profiles scroll-view">
                                @foreach($lastUser as $user)
                                <li class="media event">
                                    <a style="width:70px;height:70px;padding:0" class="pull-left border-aero profile_thumb">
                                        @if($user->image==null)
                                            <img style="width:100%;height:100%;border-radius: 50%;"   src="https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png" border="0" width="40" class="img-rounded rounded-circle" align="center" />


                                            @else
                                        <img style="width:100%;height:100%;border-radius: 50%;"  src='{{asset($user->image)}}' border="0" width="40" class="img-rounded rounded-circle" align="center" />
                                        @endif
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="{{route('realtor.show',$user->id)}}">{{$user->name}}</a>
                                        <p><strong>{{trans('backend.company_name')}}</strong> {{$user->realtor->company_name}} </p>

                                    </div>
                                </li>
                              @endforeach
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                {{trans('backend.lastcomment')}}

                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @foreach($lastcomment as $comment)
                            <article class="media event">
                                <a class="pull-left date">
                                    <p style="font-size:12px" class="day">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</p>
                                </a>
                                <div class="media-body">
                                    <a class="title" href="{{route('realtor.show',$comment->user_id)}}">{{$comment->user->name}}</a>
                                    <p>{{$comment->comment}}</p>
                                </div>
                            </article>
                                @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                {{trans('backend.lastreport')}}

                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @foreach($lastreport as $report)
                            <article class="media event">
                                <a class="pull-left date">
                                    <p style="font-size:12px"  class="day">{{ \Carbon\Carbon::parse($report->created_at)->diffForHumans()}}</p>
                                </a>
                                <div class="media-body">
                                    <a class="title" href="{{route('realtor.show',$report->user_id)}}">{{$report->user->name}}</a>
                                    <p>{{$report->report}}</p>
                                </div>
                            </article>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- /page content                                        <i class="fa fa-user aero"></i>
   -->
@endsection
