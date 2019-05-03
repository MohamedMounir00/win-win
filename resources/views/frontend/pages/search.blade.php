@extends('frontend.layouts.app')

@section('content')

    @php

        $lang = LaravelLocalization::getCurrentLocale();

    @endphp

<div class="search-page">
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <input id="search" class="form-control serch-input rounded-pill" type="search" placeholder="{{trans('frontend.search')}}">
                <div id="result" class="search-body">
                    @foreach($units as $u)
                    <div class="latest-search-units">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                                <div class="unit-img">
                                    <img class="img-fluid rounded-circle" src="{{asset('frontend')}}/images/login-img.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="unit-description">
                                    <h2> <a href="{{route('details',$u->id)}}"> {{$u->title}}</a></h2>
                                    <p>{{date('Y-m-d' , strtotime($u->created_at))}}</p>
                                    <span><i class="fa fa-gear"></i> {{unserialize($u->unit_type->name)[$lang]}}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="price">
                                    <span>{{$u->price}}{{trans('frontend.L_E')}}</span>
                                    <p>{{trans('frontend.price')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                 @endforeach
                </div>


            </div>

            <div class="col-md-4">
                <span class="serch-form-title">{{trans('frontend.result_search')}}</span>
                <div class="search-form">
                    <div class="chose">
                        <div class="mychose custom-control custom-checkbox custom-control-inline">
                            <input type="radio" id="customCheck1" name="legend" value="sale"class="custom-control-input">
                            <label class="custom-control-label" for="customCheck1"> {{trans('frontend.Buy')}}</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="radio" id="customCheck2" value="rent"  name="legend" class="custom-control-input">
                            <label class="custom-control-label" for="customCheck2"> {{trans('frontend.Rent')}}</label>
                        </div>
                    </div>

                    <div class="city-select">
                        <label>{{trans('frontend.City')}}</label>
                        <select name="city"  class="form-control custom-select" >
                         <option value="">{{trans('frontend.City')}}</option>
                            @foreach($city as $c)
                                <option value="{{$c->id}}" >{{unserialize($c->name)[$lang]}}</option>

                            @endforeach
                        </select>
                    </div>


                    <div class="state-select">
                        <label>{{trans('frontend.State')}}</label>
                        <select  name="state" class="form-control custom-select" required>
                            <option value="">{{trans('frontend.State')}}</option>

                            @foreach($state as $c)
                                <option value="{{$c->id}}" >{{unserialize($c->name)[ $lang]}}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="bedrooms">
                        <label class="title">  {{trans('frontend.rooms')}}</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> {{trans('frontend.from')}}</label>
                                    <input type="number" class="form-control"  name="bedrooms_from"  >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('frontend.to')}}</label>
                                    <input type="number" class="form-control" name="bedrooms_to" >
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="finish">
                        <label class="title d-block">{{trans('frontend.Finishing')}}</label>
                        <div class="mychose custom-control custom-checkbox custom-control-inline">
                            <input type="radio" id="customCheck3" name="finishing" value="yes" class="custom-control-input">
                            <label class="custom-control-label" for="customCheck3">{{trans('frontend.yes')}}</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="radio" id="customCheck4" name="finishing" value="no" class="custom-control-input">
                            <label class="custom-control-label" for="customCheck4">{{trans('frontend.no')}}</label>
                        </div>
                    </div>



                    <div class="floor">
                        <label class="title"> {{trans('frontend.Floor')}}</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> {{trans('frontend.from')}}</label>
                                    <input type="number" name="floor_from" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('frontend.to')}}</label>
                                    <input type="number" name="floor_to"  class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="area">
                        <label class="title">{{trans('frontend.Area')}}</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> {{trans('frontend.from')}}</label>
                                    <input type="number" name="area_from" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('frontend.to')}}</label>
                                    <input type="number" name="area_to" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="price">
                        <label class="title">{{trans('frontend.price')}}</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> {{trans('frontend.from')}}</label>
                                    <input type="number" name="price_from" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('frontend.to')}}</label>
                                    <input type="number" name="price_to" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-block btn-lg" id="submit-search">{{trans('frontend.search')}}</button>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- End Introduction Section -->



<!-- Start Dealing Section -->

    <section class="homepage-deal">
        <div class="container">
            <div class="row text-center justify-content-md-center">

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="#" class="main">
                        <div data-tilt class="deal-section">
                            <i class="sell-i fa fa-hand-paper-o"></i>
                            <h3> {{trans('frontend.Buy')}}</h3>

                            <p>{{trans('frontend.desc_lorm')}}</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="#" class="main">
                        <div data-tilt class="deal-section">
                            <i class="fa fa-home"></i>
                            <h3> {{trans('frontend.Rent')}}</h3>
                            <p>{{trans('frontend.desc_lorm')}}</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')


    <script>

        $(document).ready(function(){

            // Show Latest Unites With Ajax From Backend API
            $("#submit-search").click(function() {
                goSearch()
              //  searchEngine($("#search").value, $("input[name=finishing]:checked").val());
            });

            $( "#search" ).keyup(function() {
                goSearch()
              //  searchEngine(this.value, $("input[name=finishing]:checked").val());

            });



            // Live Search With Ajax After Display Unites From Backend API



        });


        function goSearch() {
            searchEngine(
                $("input[id=search]").val(),
                $("input[name=legend]:checked").val(),
                $("input[name=finishing]:checked").val(),
                $('select[name=city]').val(),
                $('select[name=state]').val(),
                $("input[name=bedrooms_from]").val(),
                $("input[name=bedrooms_to]").val(),
                $("input[name=floor_from]").val(),
                $("input[name=floor_to]").val(),
                $("input[name=area_from]").val(),
                $("input[name=area_to]").val(),
                $("input[name=price_from]").val(),
                $("input[name=price_to]").val(),

            );
        }
        function searchEngine(string="", legend = "",finishing = "", city = "", state = "", bedrooms_from = "",
                              bedrooms_to = "",  floor_from = "", floor_to = "", area_from = "",
                              area_to = "", price_from = "", price_to = "") {
            $.ajax({
                url: '{{route('advanced_search')}}',
                method: 'post',
                data : {
                    title           : string,
                    status          : legend,
                    finishing       : finishing,
                    city            : city,
                    state           : state,
                    bedrooms_from   : bedrooms_from,
                    bedrooms_to     : bedrooms_to,
                    floor_from      : floor_from,
                    floor_to        : floor_to,
                    area_from       : area_from,
                    area_to         : area_to,
                    price_from      : price_from,
                    price_to        : price_to,

                },
                beforeSend: function () {
                    $('.spinner').show();
                    $('#result').empty();
                    $('#result').append("Loading ...");
                },
                complete: function () {
                    $('.spinner').hide();
                },
                success: function (data) {
                    $('#result').empty();
                    $.each(data.data, function(key, value){
                        $('#result').append(
                            '<div class="latest-search-units">'+
                            '<div class="row no-gutters">'+
                            '<div class="col-md-3">'+
                            '<div class="unit-img">'+
                            '<img class="img-fluid rounded-circle" src="{{asset('frontend')}}/images/login-img.jpg" alt="">' +
                            '</div>'+
                            '</div>'+
                            '<div class="col-md-6">'+
                            '<div class="unit-description">'+
                            '<h2> <a href="'+value.url+'"> '+ value.title +'</a></h2>'+
                            '<p>'+ value.date +'</p>'+
                            '<span><i class="fa fa-gear"></i>'+value.type+'</span>'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-md-3">'+
                            '<div class="price">'+
                            '<span>'+value.price+'</span>'+
                            '<p>'+value.string_prics+'</p>'+
                            '</div>'+
                            '</div>'+
                            '</div>'+
                            ' </div>'

                        );
                    });
                }
            });


        }

    </script>




@endsection