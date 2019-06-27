@extends('frontend.layouts.app')
@section('page_title' , trans('frontend.home'))

@section('content')
    @php

        $lang = LaravelLocalization::getCurrentLocale();

    @endphp
    <section class="intro text-center">
        <div class="container">
            <img class="img-fluid"  src="{{asset('frontend')}}/images/logo.png">
            <p class="lead">
                @if($lang=='ar')
                    {{\App\Helper\Helper::get_setting('desc_web_ar')->value}}
                @else
                    {{\App\Helper\Helper::get_setting('desc_web_en')->value}}
                @endif
            </p>
            {!! Form::open(['route'=>['search-form'],'method'=>'POST','class'=>'form-inline','novalidate']) !!}

                <input type="search" name="title" class="form-control" placeholder="{{trans('frontend.search')}}">
                <button type="submit" class="my-btn btn btn-primary">{{trans('frontend.search')}}</button>
            {!! Form::close() !!}
        </div>
    </section>

    <!-- End Introduction Section -->



    <!-- Start Dealing Section -->
    @include('frontend.partials.dealing')


@endsection
