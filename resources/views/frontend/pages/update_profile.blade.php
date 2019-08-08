@extends('frontend.layouts.app')
@section('page_title' , trans('frontend.update_profile'))

@section('content')

    @php

        $lang = LaravelLocalization::getCurrentLocale();

    @endphp

    <!-- Start Dealing Section -->


    <div class="add-new-unit">
        <div class="container">
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
            <div class="row no-gutters">

                <div class="col-md-12">
                    <div class="container">
                        <div class="add-new-info">
                            <div class="section-head">
                                <h2>{{trans('frontend.update_profile')}}</h2>
                            </div>
                            {!! Form::open(['route'=>['updatet_profile'],'method'=>'POST','class'=>'form-horizontal form-label-left ', 'id' => 'form','files'=>true]) !!}
                        <div class="form-row">
                        {{--    <div class="col-md-12">

                                <div class="row">
                                <div class="col-sm-12">
                                        <p> {{trans('frontend.Upload_User_Photo')}}</p>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="upload-image">
                                            <input id="profileImage" type="file" class="dropify" name="image" 
                                                   data-errors-position="outside">
                                        </div>
                                    </div>



                                </div>
                            </div>--}}

                            <div class="col-lg-6 col-md-12">
                                <label>{{trans('frontend.user_name')}}</label>
                                <input type="text"  name="name" required class="form-control" value="{{$user->name}}">
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label>{{trans('frontend.Company_Name')}}</label>
                                <input type="text" name="company_name"  class="form-control" value="{{$user->realtor->company_name}}">
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label>{{trans('frontend.Email')}}</label>
                                <input type="email"  name="email"  required class="form-control"  value="{{$user->email}}">
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <label>{{trans('frontend.Phone')}}</label>
                                <input type="text"  name="phone" class="form-control"  value="{{$user->phone}}">
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label> {{trans('frontend.Mobile_number')}}</label>
                                <input type="text" name="phone1" class="form-control" value="{{$user->realtor->phone1}}" >
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label>{{trans('frontend.Phone')}}</label>
                                <input type="text"  name="phone2" class="form-control"   value="{{$user->realtor->phone2}}">
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label> {{trans('frontend.Mobile_number')}}</label>
                                <input type="text"  name="phone3" class="form-control"  value="{{$user->realtor->phone3}}">
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <label> {{trans('frontend.Street_Address')}}</label>
                                <input type="text"  name="address"  class="form-control" value="{{$user->realtor->address}}">
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label> {{trans('frontend.City')}}</label>
                                    <select class="form-control update-profile-select" name="city_id" required>

                                        @foreach($city as $c)
                                            <option value="{{$c->id}}" {{($user->city_id==$c->id)?'selected':''}}>{{unserialize($c->name)[$lang]}}</option>

                                        @endforeach


                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label> {{trans('frontend.State')}}</label>
                                    <select  name="state_id" class="form-control update-profile-select " required>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label> {{trans('frontend.Company_Bio')}}</label>
                                    <textarea class="form-control"  name="bio" placeholder="Enter Your Bio Of Your company">{{$user->realtor->bio}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="changing-password-title">
                                    <h2>{{trans('frontend.change_password_title')}}</h2>
                                    <hr>
                                    <span>{{trans('frontend.change_password_title_description')}}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label> {{trans('frontend.Password')}} </label>
                                <input type="password"  name="password" class="form-control" autocomplete="new-password"  >
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label> {{trans('frontend.Confirm_Password')}}</label>
                                <input type="password" name="password_confirmation" class="form-control" autocomplete="off">
                            </div>
                        </div>


                        <div class="text-center click-btn">
                            <div class="container">
                                <button type="submit" class=" my-btn btn btn-primary">{{trans('backend.update')}}</button>
                            </div>
                        </div>

                    {!! Form::close() !!}
                        </div>

                    </div>
                </div>




            </div>
        </div>
    </div>





@endsection
@section('scripts')


    <script>
$(document).ready(function() {
changeStatusUnit()
$('select[name=city_id]').change(function() {
changeStatusUnit()
})

function changeStatusUnit() {
var city = $('select[name=city_id]').val()
if (city > 0) {
$.ajax({
url: '{{url('api/state_by_id')}}',
method: 'post',
data: {
city_id : city,
    lang : '{{LaravelLocalization::getCurrentLocale()}}'
},
beforeSend: function () {
$('.spinner').show();
},
complete: function () {
$('.spinner').hide();
},
success: function (data) {
var dropdown = $('select[name=state_id]');
dropdown.empty()

$.each( data.data, function( key, value ) {
dropdown.append($('<option>', {value: value.id,text: value.state}, '</option>'))
// $('.' + value.name)[1].prop('required',true);
});
}
});

}
}

});


</script>

    </script><script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>

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
