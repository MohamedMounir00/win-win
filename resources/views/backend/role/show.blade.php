@extends('backend.layouts.app')

@section('page_title' , trans('backend.showrole'))

@section('breadcrumb')


    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">{{ trans('backend.showrole') }}</h4>
    </div>


@endsection


@section('content')

    <div class="col-sm-12">
        <div class="white-box">
            {{-- <h3 class="box-title m-b-0">Bordered Table</h3>
            <p class="text-muted m-b-20">Add<code>.table-bordered</code>for borders on all sides of the table and cells.</p> --}}
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2> {{trans('backend.showrole')}}</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> {{ trans('backend.reset') }}</a>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{ trans('backend.name') }}:</strong>
                            {{ $role->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans('backend.showrole')}}:</strong>
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $v)
                                    <label class="label label-success">  {{ trans('backend.'.$v->name )}}  </label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>


            </div>
        </div>


@endsection


