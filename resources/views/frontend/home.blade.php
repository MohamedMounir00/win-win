@extends('frontend.layouts.app')

@section('content')

    <section class="intro text-center">
        <div class="container">
            <h1>Win Win</h1>
            <p class="lead">
                {{trans('frontend.desc_home1')}} . <br> {{trans('frontend.desc_home2')}}
            </p>
            {!! Form::open(['route'=>['search-form'],'method'=>'POST','class'=>'form-inline','novalidate','files'=>true]) !!}

                <input type="search" name="title" class="form-control" placeholder="{{trans('frontend.search')}}">
                <button type="submit" class="my-btn btn btn-primary">{{trans('frontend.search')}}</button>
            {!! Form::close() !!}
        </div>
    </section>

    <!-- End Introduction Section -->



    <!-- Start Dealing Section -->

    <section class="homepage-deal">
        <div class="container">
            <div class="row text-center justify-content-md-center">

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a class="main">
                        <div data-tilt class="deal-section">
                            <i class="sell-i fa fa-hand-paper-o"></i>
                            <h3>{{trans('frontend.Buy')}}</h3>
                            <p>{{trans('frontend.desc_lorm')}}</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a  class="main">
                        <div data-tilt class="deal-section">
                            <i class="fa fa-home"></i>
                            <h3> {{trans('frontend.Rent')}}</h3>
                            <p class="lead">{{trans('frontend.desc_lorm')}}</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection
