@extends('backend.layouts.app')
@section('page_title' , trans('backend.state_create'))

@section('content')




            <div class="clearfix"></div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>{{trans('backend.state_create')}}</h3>


                            <div class="clearfix"></div>
                        </div>

                        @if(isset($errors) > 0)
                            @if(Session::has('errors'))

                                <div class="alert alert-danger " >
                                    <ul >
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endif
                        <div class="x_content">

                            {!! Form::open(['route'=>['state.store'],'method'=>'POST','class'=>'form-horizontal form-label-left ','novalidate','files'=>true]) !!}


                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs right" role="tablist">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                                        <li role="presentation" class="{{$loop->iteration === 2 ? 'active' : '' }}"><a href="#{{ $properties['native'] }}" role="tab" id="profile-tab"
                                                                            data-toggle="tab" aria-expanded="false">{{trans('backend.'.$properties['name'])}}</a>
                                        </li>
                                    @endforeach

                                </ul>
                                <div id="myTabContent" class="tab-content">

                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                                        <div role="tabpanel" class="tab-pane fade  {{$loop->iteration == 2 ? 'active' : '' }} in" id="{{$properties['native']}}"
                                             aria-labelledby="profile-tab">
                                            <div class="tab-pane " id="{{ $properties['native'] }}">
                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{trans('backend.name_'.$properties['name'])}} <span
                                                        >*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" id="first-name" maxlength="25" name="name[{{$localeCode}}]" required class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">{{trans('backend.cities')}} <span
                                        >*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  name="city_id" id="heard" class="form-control" required>
                                            <option value="">{{trans('backend.cities')}}</option>
                                            @foreach($city as $c)
                                                <option value="{{$c->id}}">{{unserialize($c->name)[ LaravelLocalization::getCurrentLocale()]}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                               <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{trans('backend.ordering')}} <span
                                                        >*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="number" id="first-name" maxlength="25"   name="ordering" required class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button id="send" type="submit" class="btn btn-success">{{trans('backend.save')}}</button>
                                        <a href="{{route('state.index')}}"  class="btn btn-primary">{{trans('backend.back')}}</a>

                                    </div>
                                </div>
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>


@endsection

@section('scripts')



    <script>

        $('.dropify').dropify({
            tpl: {
                wrap:            '<div class="dropify-wrapper"></div>',
                loader:          '<div class="dropify-loader"></div>',
                message:         '<div class="dropify-message"><span class="file-icon" /> <p>  {{trans("backend.upload_image")}}  </p></div>',
                preview:         '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">delete</p></div></div></div>',
                filename:        '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
                clearButton:     '<button type="button" class="dropify-clear">delete</button>',
                errorLine:       '<p class="dropify-error"> error</p>',
                errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>'
            }
        });
    </script>


@endsection
