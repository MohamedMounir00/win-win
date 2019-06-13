@extends('backend.layouts.app')
@section('page_title' , trans('backend.unit_details'))
@section('styles')
    <style>

        .product_gallery a {
            height: 150px !important;
            width: 150px !important;
        }

        .product_gallery a img {
            height: 100% !important;
            width: 100% !important;
            margin-top: 0px !important
        }

        .product_price {
            min-height: 150px;
        }

        .product_price {
            padding: 60px 0;
        }

        .tile-stats {
            text-align: center;
            color: #0f0f0f;
        }

        .tile-stats h5{
            font-weight: 100;
            font-size: 18px;
        }

        .tile-stats p{
            font-weight: bold;
            font-size: 20px;
        }
    </style>
    @endsection
@section('content')
    @php
        $lang= Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale()



    @endphp

    <div class="">


        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 style="color: #0f0f0f">{{$data->title}}</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                @if($data->activation_admin=='active')
                                    <a href="{{route('unit.active',$data->id)}}"
                                       class="btn btn-danger ">{{trans('backend.not_activation')}}</a>
                                @else
                                    <a href="{{route('unit.active',$data->id)}}"
                                       class="btn btn-primary ">{{trans('backend.activation')}}</a>
                                @endif
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

                                <p class="lead" style="color: #0f0f0f;">{{$data->desc}}</p>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="product_price">
                                    <h1 class="price" style="font-size:25px; text-align: center; font-weight: bold">
                                        @if($data->price==null)
                                            {{trans('backend.without')}}
                                        @else
                                            {{trans('backend.currency')}} {{$data->price}}</h1>
                                    @endif
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

                                <div class="product_gallery">
                                    @foreach($data->storge as $item)
                                        <a href="{{url($item->url)}}" data-lightbox="image-1"> <img
                                                    src="{{url($item->url)}}" alt="..." /> </a>
                                    @endforeach

                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                                <div class="well profile_view">
                                    <div class="col-sm-12"  onclick="location.href='{{ route('realtor.show', $data->user_id)}}'">
                                        <div class="left col-xs-7">
                                            <h2>{{$data->realtor->name}}</h2>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-building"></i> {{$data->realtor->email}} </li>
                                                <li><i class="fa fa-phone"></i> {{$data->realtor->phone}} </li>
                                            </ul>
                                        </div>
                                        <div class="right col-xs-5 text-center">
                                            @if($data->realtor->image==null)
                                                <img src="https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png" alt="" class="img-circle img-responsive">

                                            @else
                                                <img src="{{url($data->realtor->image)}}" alt="" class="img-circle img-responsive">

                                                @endIf
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div style="border:0px solid #e5e5e5;">
                            <h3 style="padding-bottom: 10px;" class="prod_title">{{trans('backend.unit_details')}}</h3>

                                <div class="animated flipInY col-md-4 col-sm-12">
                                    <div class="tile-stats">
                                        <h5 style="text-align: center ;font-weight: bold" >{{trans('backend.type')}}</h5>
                                        <p style="text-align: center">{{unserialize($data->unit_type->name)[$lang]}}</p>
                                    </div>
                                </div>
                                <div class="animated flipInY col-md-4 col-sm-12">
                                    <div class="tile-stats">
                                        <h5 style="text-align: center ;font-weight: bold">{{trans('backend.city')}}</h5>
                                        @if($data->city_id==null)
                                            <p style="text-align: center">{{trans('backend.without')}}</p>
                                        @else
                                            <p style="text-align: center">{{unserialize($data->city->name)[$lang]}}</p>
                                        @endif                                    </div>
                                </div>

                                <div class="animated flipInY col-md-4 col-sm-12">
                                    <div class="tile-stats">
                                        <h5 style="text-align: center ;font-weight: bold">{{trans('backend.state')}}</h5>
                                        @if($data->state_id==null)
                                            <p style="text-align: center">{{trans('backend.without')}}</p>
                                        @else
                                            <p style="text-align: center">{{unserialize($data->state->name)[$lang]}}</p>
                                        @endif                                    </div>
                                </div>
                                <div class="animated flipInY col-md-4 col-sm-12">
                                    <div class="tile-stats">
                                        <h5 style="text-align: center ;font-weight: bold">{{trans('backend.bathroom')}}</h5>
                                        @if($data->bathroom==null)
                                            <p style="text-align: center"> {{trans('backend.without')}}</p>
                                        @else
                                            <p style="text-align: center">   {{ $data->bathroom }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="animated flipInY col-md-4 col-sm-12">
                                    <div class="tile-stats">
                                        <h5 style="text-align: center ;font-weight: bold">{{trans('backend.area')}}</h5>
                                        @if($data->area==null)
                                            <p style="text-align: center">  {{trans('backend.without')}}</p>
                                        @else
                                            <p style="text-align: center">  {{ $data->area }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="animated flipInY col-md-4 col-sm-12">
                                    <div class="tile-stats">
                                        <h5 style="text-align: center ;font-weight: bold">{{trans('backend.status')}}</h5>
                                        @if($data->status=='sale')
                                            <p style="text-align: center"> {{ trans('backend.sale') }}</p>
                                        @elseif($data->status=='rent')
                                            <p style="text-align: center"> {{ trans('backend.rent') }}</p>
                                        @else
                                            <p style="text-align: center"> {{ trans('backend.without') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="animated flipInY col-md-4 col-sm-12">
                                    <div class="tile-stats">
                                        <h5 style="text-align: center ;font-weight: bold">{{trans('backend.payment_method')}}</h5>
                                        @if($data->payment_method=='cash')
                                            <p style="text-align: center">{{ trans('backend.cash') }}</p>

                                        @elseif($data->payment_method=='installments')
                                            <p style="text-align: center">{{ trans('backend.installments') }}</p>
                                        @else
                                            <p style="text-align: center">   {{ trans('backend.without') }}</p>


                                        @endif
                                    </div>
                                </div>
                                <div class="animated flipInY col-md-4 col-sm-12">
                                    <div class="tile-stats">
                                        <h5 style="text-align: center ;font-weight: bold">{{trans('backend.rooms')}}</h5>
                                        @if($data->rooms==null)
                                            <p style="text-align: center">  {{trans('backend.without')}}</p>
                                        @else
                                            <p style="text-align: center"> {{ $data->rooms }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="animated flipInY col-md-4 col-sm-12">
                                    <div class="tile-stats">
                                        <h5 style="text-align: center ;font-weight: bold">{{trans('backend.floor')}}</h5>
                                        @if($data->floor==null)
                                            <p style="text-align: center">  {{trans('backend.without')}}</p>
                                        @else
                                            <p style="text-align: center">    {{ $data->floor }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="animated flipInY col-md-4 col-sm-12">
                                    <div class="tile-stats">
                                        <h5 style="text-align: center ;font-weight: bold">{{trans('backend.finishing')}}</h5>
                                        @if($data->finishing=='yes')
                                            <p style="text-align: center">{{ trans('backend.yes') }}</p>
                                        @elseif($data->finishing=='no')
                                            <p style="text-align: center">   {{ trans('backend.no') }}</p>
                                        @else
                                            <p style="text-align: center"> {{ trans('backend.without') }}</p>

                                        @endif
                                    </div>
                                </div>










                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
