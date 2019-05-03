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

                        <div class="col-md-8">

                            <h2>{{trans('frontend.About_Us')}}</h2>
                            <div class="about-para">
                              @if($lang=='ar')
                                  {{\App\Helper\Helper::get_setting('about_us_ar')->value}}
                                  @else
                                    {{\App\Helper\Helper::get_setting('about_us_en')->value}}
                                @endif

                            </div>
                            <div class="social-media">
                                <h2>{{trans('frontend.Slocial_Media')}}</h2>
                                
                                <a href=" {{\App\Helper\Helper::get_setting('facebook')->value}}"><i class="fa fa-facebook"></i></a>
                                <a href="{{\App\Helper\Helper::get_setting('google')->value}}"><i class="fa fa-google"></i></a>
                                <a href="{{\App\Helper\Helper::get_setting('insta')->value}}"><i class="fa fa-instagram"></i></a>
                                <a href="{{\App\Helper\Helper::get_setting('twitter')->value}}"><i class="fa fa-twitter"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="top-brokers">
                                <h2> {{trans('frontend.Top_Brokers')}}</h2>
                                <ul class="list-unstyled">
                                    @foreach($users as $image)
                                        @if($image->image==null)
                                            <li><img class="img-thumbnail" src="https://www.mycustomer.com/sites/all/modules/custom/sm_pp_user_profile/img/default-user.png" alt=""></li>

                                        @else
                                         <li><img class="img-thumbnail" src="{{url($image->image)}}" alt=""></li>
                                        @endif
                                        @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-4">
                <div class="contact">
                    <h2>{{trans('frontend.Contact_Us')}}</h2>
                    <form>
                        <input type="text" class="form-control" placeholder="Name">
                        <input type="email" class="form-control" placeholder="Email">
                        <input type="tel" class="form-control" placeholder="Phone">
                        <textarea class="form-control" placeholder="Message"></textarea>
                        <button type="submit" class="my-btn btn btn-primary">{{trans('frontend.Next')}}</button>
                    </form>
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

</script>
@include('sweet::alert')

@yield('scripts')

