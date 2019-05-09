<footer>
@php
    $users=  App\User::whereHas('realtor', function ($q) {})->take(10)->get();
    $lang = LaravelLocalization::getCurrentLocale();

    @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="about">
                    <div class="row">

                        <div class="col-md-12">

                            <h2>{{trans('frontend.About_Us')}}</h2>
                            <div class="about-para">
                              @if($lang=='ar')
                                  {{\App\Helper\Helper::get_setting('about_us_ar')->value}}
                                  @else
                                    {{\App\Helper\Helper::get_setting('about_us_en')->value}}
                                @endif
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-12 col-lg-4">
                <div class="contact">
                    <h2>{{trans('frontend.Contact_Us')}}</h2>
                   {{-- {!! Form::open(['route'=>'contact_us']) !!}

                        {!! Form::text('name', old('name'), ['class'=>'form-control','required', 'placeholder'=>trans('frontend.user_name')]) !!}

                        {!! Form::text('email', old('email'), ['class'=>'form-control','required', 'placeholder'=>trans('frontend.Email')]) !!}
                        {!! Form::text('phone', old('phone'), ['class'=>'form-control', 'required','placeholder'=>trans('frontend.Phone')]) !!}

                        {!! Form::textarea('message', old('message'), ['class'=>'form-control','required', 'placeholder'=>trans('frontend.message')]) !!}

                        <button type="submit" class="my-btn btn btn-primary">{{trans('frontend.send')}}</button>

                    {!! Form::close() !!} --}}

                    <div class="social-network">
                        <b> {{trans('frontend.Phone')}}</b>
                        <span>{{\App\Helper\Helper::get_setting('contact_us')->value}}</span>
                        <b> {{trans('frontend.Email')}}</b>
                        <span>{{\App\Helper\Helper::get_setting('email')->value}}</span>
                    </div>
                    <div class="social-media">
                        <h2  style="margin-bottom:0 !important;">{{trans('frontend.Slocial_Media')}}</h2>

                        <ul class="list-unstyled">
                            <li>  <a target="_blank" href=" {{\App\Helper\Helper::get_setting('facebook')->value}}"><i class="fa fa-facebook"></i></a></li>
                            <li> <a target="_blank" href="{{\App\Helper\Helper::get_setting('google')->value}}"><i class="fa fa-google"></i></a></li>
                            <li> <a target="_blank" href="{{\App\Helper\Helper::get_setting('insta')->value}}"><i class="fa fa-instagram"></i></a></li>
                            <li> <a target="_blank" href="{{\App\Helper\Helper::get_setting('twitter')->value}}"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                    
                </div>
            </div>


        </div>
    </div>
    <div class="copr-right">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-7">
                    <div class="title">
                        <p>Tel : 01212112212 - Fax : 01222122122</p>
                        <p>Nasr city , Cairo , Egypt</p>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div class="copyRight">
                        <span>&copy; Real Estate | All Right Reserved | By Sprints</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- End Footer -->

<div class="modal"><!-- Place at bottom of page --></div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="{{asset('frontend')}}/js/plugin.js"></script>
<script src="{{asset('frontend')}}/js/fakeLoader.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // Page Loading 
        $.fakeLoader({
            spinner : 'spinner3',
            bgColor : '#3787E0'
        });
    });
</script>
<script src="{{asset('frontend')}}/js/tilt.jquery.js"></script>
<script src="{{asset('frontend')}}/js/jquery.uploadfile.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('frontend')}}/js/lightbox.js"></script>

<script type="text/javascript">

    $body = $("body");

    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
         ajaxStop: function() { $body.removeClass("loading"); }    
    });
        
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    })
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });

</script>

@include('sweet::alert')

@yield('scripts')

