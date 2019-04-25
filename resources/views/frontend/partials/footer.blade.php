<footer>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="about">
                    <div class="row">

                        <div class="col-md-8">

                            <h2>{{trans('frontend.About_Us')}}</h2>
                            <div class="about-para">
                              {{trans('frontend.desc_lorm')}}
                            </div>
                            <div class="social-media">
                                <h2>{{trans('frontend.Slocial_Media')}}</h2>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="top-brokers">
                                <h2> {{trans('frontend.Top_Brokers')}}</h2>
                                <ul class="list-unstyled">
                                    <li><img class="img-thumbnail" src="{{asset('frontend')}}/images/brokerr.jpg" alt=""></li>
                                    <li><img class="img-thumbnail" src="{{asset('frontend')}}/images/broker2.jpg" alt=""></li>
                                    <li><img class="img-thumbnail" src="{{asset('frontend')}}/images/brokerr.jpg" alt=""></li>
                                    <li><img class="img-thumbnail" src="{{asset('frontend')}}/images/broker2.jpg" alt=""></li>
                                    <li><img class="img-thumbnail" src="{{asset('frontend')}}/images/brokerr.jpg" alt=""></li>
                                    <li><img class="img-thumbnail" src="{{asset('frontend')}}/images/broker2.jpg" alt=""></li>
                                    <li><img class="img-thumbnail" src="{{asset('frontend')}}/images/brokerr.jpg" alt=""></li>
                                    <li><img class="img-thumbnail" src="{{asset('frontend')}}/images/broker2.jpg" alt=""></li>
                                    <li><img class="img-thumbnail" src="{{asset('frontend')}}/images/brokerr.jpg" alt=""></li>
                                    <li><img class="img-thumbnail" src="{{asset('frontend')}}/images/brokerr.jpg" alt=""></li>
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


<script src="https://code.jquery.com/jquery-3.1.1.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="{{asset('frontend')}}/js/plugin.js"></script>
<script src="{{asset('frontend')}}/js/fakeLoader.min.js"></script>
<script src="{{asset('frontend')}}/js/tilt.jquery.js"></script>
@yield('scripts')
</body>

</html>
