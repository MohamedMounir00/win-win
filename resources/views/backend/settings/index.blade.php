@extends('backend.layouts.app')

@section('content')




    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3>{{trans('backend.get_settings')}}</h3>

                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                </ul>
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

                {!! Form::open(['route'=>['post_settings'],'method'=>'POST','class'=>'form-horizontal form-label-left ','novalidate','files'=>true]) !!}
                <table id="table1" class="table table-striped table-bordered bulk_action table1">

                    @foreach($settings as $setting)
                        <tr>
                            <th>
                                <div class="col-md-6 col-sm-6 col-xs-12">

                            @if($setting->key=='about_us_ar')
                                    {{trans('backend.about_us_ar')}}
                                @elseif($setting->key=='about_us_en')
                                        {{trans('backend.about_us_en')}}
                                @elseif($setting->key=='contact_us')
                                        {{trans('backend.contact_us')}}

                                @endif
                                </div>
                            </th>
                            <td>
                                <div class="col-md-6 col-sm-6 col-xs-12">

                                        <textarea name="{{ $setting->key }}" class="form-control form-control-line" rows="5" required >{{ $setting->value  }}</textarea>

                                </div>
                            </td>
                        </tr>


                    @endforeach
                </table>


                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="send" type="submit" class="btn btn-success">{{trans('backend.update')}}</button>

                        </div>
                    </div>
                </div>

                {!! Form::close() !!}

        </div>
    </div>
    



@endsection

@section('scripts')






@endsection
