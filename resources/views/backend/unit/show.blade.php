@extends('backend.layouts.app')

@section('content')
    @php
        $lang= Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale()



    @endphp

    <div class="">


        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{trans('backend.unit_details')}}</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="col-md-7 col-sm-7 col-xs-12">

                            <div class="product_gallery">
                                @foreach($data->storge as $item)


                                    <a>
                                        <img src="{{url($item->url)}}"
                                             alt="..."/>
                                    </a>
                                @endforeach

                            </div>
                        </div>

                        <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                            <h3 class="prod_title">{{$data->title}}</h3>

                            <p>{{$data->desc}}</p>
                            <br>

                            <div class="">
                                <h2>{{trans('backend.type')}}</h2>
                                <ul class="list-inline prod_color">
                                    <li>
                                        <p>{{unserialize($data->unit_type->name)[$lang]}}</p>
                                    </li>


                                </ul>
                            </div>
                            <br>
                            <div class="">
                                <h2>{{trans('backend.city')}}</h2>
                                <ul class="list-inline prod_color">
                                    <li>
                                        @if($data->city_id==null)
                                            <p>{{trans('backend.without')}}</p>
                                        @else
                                        <p>{{unserialize($data->city->name)[$lang]}}</p>
                                        @endif

                                    </li>


                                </ul>
                            </div>

                            <br>
                            <div class="">
                                <h2>{{trans('backend.state')}}</h2>
                                <ul class="list-inline prod_color">
                                    <li>

                                        @if($data->state_id==null)
                                            <p>{{trans('backend.without')}}</p>
                                        @else
                                        <p>{{unserialize($data->state->name)[$lang]}}</p>
                                            @endif
                                    </li>


                                </ul>
                            </div>
                            <div class="">
                                <h2><small>{{trans('backend.unit_details')}}</small></h2>
                                <ul class="list-inline prod_size">
                                    <li>
                                        <div class=" well text-center">
                                            <h3>{{ trans('backend.bathroom') }}</h3>
                                            @if($data->bathroom==null)
                                                {{trans('backend.without')}}
                                            @else
                                            {{ $data->bathroom }}
                                                @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class=" well text-center">
                                            <h3>{{ trans('backend.area') }}</h3>
                                            @if($data->area==null)
                                                {{trans('backend.without')}}
                                            @else
                                            {{ $data->area }}
                                            @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class=" well text-center">
                                            <h3>{{ trans('backend.status') }}</h3>

                                        @if($data->status=='sale')
                                                {{ trans('backend.sale') }}
                                                @elseif($data->status=='rent')
                                                {{ trans('backend.rent') }}
                                                @else
                                                    {{ trans('backend.without') }}
                                            @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class=" well text-center">
                                            <h3>{{ trans('backend.bathroom') }}</h3>
                                            @if($data->bathroom==null)
                                                {{trans('backend.without')}}
                                            @else
                                            {{ $data->bathroom }}
                                                @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class=" well text-center">
                                            <h3>{{ trans('backend.payment_method') }}</h3>
                                            @if($data->payment_method=='cash')
                                                {{ trans('backend.cash') }}

                                            @elseif($data->payment_method=='installments')
                                                {{ trans('backend.installments') }}
                                                @else
                                                {{ trans('backend.without') }}


                                            @endif


                                        </div>
                                    </li>
                                    <li>
                                        <div class=" well text-center">
                                            <h3>{{ trans('backend.rooms') }}</h3>
                                            @if($data->rooms==null)
                                                {{trans('backend.without')}}
                                            @else
                                            {{ $data->rooms }}
                                            @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class=" well text-center">
                                            <h3>{{ trans('backend.floor') }}</h3>
                                            @if($data->floor==null)
                                                {{trans('backend.without')}}
                                            @else
                                            {{ $data->floor }}
                                                @endif
                                        </div>
                                    </li>

                                    <li>
                                        <div class=" well text-center">
                                            <h3>{{ trans('backend.finishing') }}</h3>
                                           @if($data->finishing=='yes')
                                                {{ trans('backend.yes') }}
                                               @elseif($data->finishing=='no')
                                                {{ trans('backend.no') }}
                                               @else
                                                {{ trans('backend.without') }}

                                            @endif


                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <br>


                            <div class="">
                               @if($data->activation_admin=='active')
                                <a href="{{route('unit.active',$data->id)}}" class="btn btn-danger ">{{trans('backend.not_active')}}</a>
                                @else
                                <a href="{{route('unit.active',$data->id)}}" class="btn btn-primary ">{{trans('backend.active')}}</a>
                                   @endif
                            </div>


                            <br>
                            <div class="row">

                                <ul class="list-inline prod_size pull-right">

                                    <h2>
                                        {{trans('backend.realtor_details')}}
                                    </h2>
                                    <li>

                                        <a href="{{ route('realtor.show', $data->user_id)}}"> <span>{{$data->realtor->name}}</span></a>
                                    </li>
                                    <br>
                                    <li>
                                        <span>{{$data->realtor->email}}</span>
                                    </li>
                                    <br>
                                    <li>
                                        <span>{{$data->realtor->phone}}</span>
                                    </li>

                                </ul>


                            </div>

                            <div class="">
                                <div class="product_price">
                                    <h1 class="price">
                                        @if($data->price==null)
                                            {{trans('backend.without')}}
                                        @else
                                        {{trans('backend.currency')}} {{$data->price}}</h1>
                                    @endif
                                    <br>
                                </div>
                            </div>






                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
