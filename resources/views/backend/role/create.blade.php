@extends('backend.layouts.app')

@section('page_title' , trans('backend.role'))

@section('breadcrumb')

    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">{{ trans('backend.role') }}</h4>
    </div>

@endsection


@section('content')


    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0"></h3>
            <p class="text-muted m-b-30 font-13"> {{ __('backend.role') }} </p>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <section class="m-t-40">

                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                    <h2>{{ trans('backend.create') }}</h2>
                                </div>
                                <div class="pull-right">
                                    <a class="btn btn-primary" href="{{ route('roles.index') }}"> {{ trans('backend.back') }}</a>
                                </div>
                            </div>
                        </div>


                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{trans('backend.name')}}</strong>
                                    {!! Form::text('name', null, array('placeholder' => trans('backend.name'),'class' => 'form-control','required')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{trans('backend.role')}}</strong>
                                    <br/>
                                    @foreach($permission as $value)
                                        <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            {{ trans('backend.'.$value->name )}}</label>
                                        <br/>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">{{ trans('backend.create') }}</button>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </section>
                </div>
            </div>
        </div>
    </div>





@endsection




@section('scripts')


    <!-- For Switch  -->


@endsection