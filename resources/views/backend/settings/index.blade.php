@extends('backend.layouts.app')
@section('page_title' , trans('backend.get_settings'))

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
                                    @elseif($setting->key=='email')
                                        {{trans('backend.email')}}
                                    @elseif($setting->key=='facebook')
                                        {{trans('backend.facebook')}}
                                    @elseif($setting->key=='google')
                                        {{trans('backend.google')}}
                                    @elseif($setting->key=='twitter')
                                        {{trans('backend.twitter')}}
                                    @elseif($setting->key=='insta')
                                        {{trans('backend.insta')}}
                                    @elseif($setting->key=='desc_web_en')
                                        {{trans('backend.desc_web_en')}}
                                    @elseif($setting->key=='desc_web_ar')
                                        {{trans('backend.desc_web_ar')}}
                                @endif
                                </div>
                            </th>
                            <td>
                                @if($setting->key=='about_us_ar'||$setting->key=='about_us_en'||$setting->key=='desc_web_ar'||$setting->key=='desc_web_en')
                                <div class="col-md-6 col-sm-6 col-xs-12">

                                        <textarea name="{{ $setting->key }}" class="form-control col-md-7 col-xs-12" rows="5" required >{{ $setting->value  }}</textarea>

                                </div>
                                    @else
                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                        <input name="{{ $setting->key }}" class="form-control form-control-line"  required value="{{ $setting->value  }}" >

                                    </div>
                                @endif
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

    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>


@endsection
