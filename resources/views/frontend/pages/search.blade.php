@extends('frontend.layouts.app')
@section('page_title' , trans('frontend.search'))

@section('content')

    @php

        $lang = LaravelLocalization::getCurrentLocale();

    @endphp

<div class="search-page">
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <input id="search" class="form-control serch-input rounded-pill" type="search" placeholder="{{trans('frontend.search')}}" value="{{$search_title}}">
                <div id="result" class="search-body">
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
                        <select  name="state" class="form-control custom-select" >
                            <option value="">{{trans('frontend.State')}}</option>
                        </select>
                    </div>

                    <div class="bedrooms">
                        <label class="title">  {{trans('frontend.rooms')}}</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> {{trans('frontend.from')}}</label>
                                    <input min="0"  type="number" class="form-control"  name="bedrooms_from"  >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('frontend.to')}}</label>
                                    <input min="0"  type="number" class="form-control" name="bedrooms_to" >
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
                                    <input min="0"  type="number" name="floor_from" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('frontend.to')}}</label>
                                    <input min="0"  type="number" name="floor_to"  class="form-control" >
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
                                    <input min="0" type="number" name="area_from" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('frontend.to')}}</label>
                                    <input min="0" type="number" name="area_to" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="price">
                        <label class="title">{{trans('frontend.price')}}</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>  {{trans('frontend.from')}}</label>
                                    <input min="0" type="number" name="price_from" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('frontend.to')}}</label>
                                    <input min="0" type="number" name="price_to" class="form-control" >
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



@endsection

@section('scripts')



    <script>

        $(document).ready(function(){
            var current_offset = 0;
            goSearch();
            // Show Latest Unites With Ajax From Backend API
            $("#submit-search").click(function() {
                goSearch()
              //  searchEngine($("#search").value, $("input[name=finishing]:checked").val());
            });

            $( "#search" ).keyup(function() {
                goSearch()
              //  searchEngine(this.value, $("input[name=finishing]:checked").val());

            });

            $('#result').on('click', '.load', function() {
                goSearch(current_offset)
            });


            // Live Search With Ajax After Display Unites From Backend API



        function goSearch(offset_count = '',) {
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
                offset_count
            );
        }
        function searchEngine(string="", legend = "",finishing = "", city = "", state = "", bedrooms_from = "",
                              bedrooms_to = "",  floor_from = "", floor_to = "", area_from = "",
                              area_to = "", price_from = "", price_to = "", offset = "") {
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
                    offset_id       : offset,
                },
                beforeSend: function () {
                    $('.spinner').show();
                    if(offset == '') {
                        $('#result').empty();
                    }
                },
                complete: function () {
                    $('.spinner').hide();
                },
                success: function (data) {
                    $('#load_btn').remove();
                    if(offset == '') {
                        $('#result').empty();
                        current_offset = 0;
                    }

                    $.each(data.data, function(key, value){

                        // var imgUrl = value.storge[0].url
                    var imgUrl = '{{url('no-photo.png')}}'
                    if (value.storge.length > 0) {
                        imgUrl = value.storge[0].url
                    }
                        $('#result').append(printUnitCard(imgUrl, value.type, value.price, value.activation,value.title,value.date,value.url, value.state));
                        current_offset++;
                    });

                    if (data.data.length > 0) {
                        $('#result').append('<input id="load_btn" type="button" class="btn btn-primary my-btn my-3 load" value="{{trans('frontend.load_more')}}" />');
                    }




                }
            });


        }

        // For changing state
        $('select[name=city]').change(function() {
            changeStatusUnit()
        })

        changeStatusUnit()
        function changeStatusUnit() {
            var city = $('select[name=city]').val()
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
                        var dropdown=$('select[name=state]');
                        dropdown.empty()
                        dropdown.append($('<option value="">---</option>'))
                        $.each( data.data, function( key, value ) {
                            dropdown.append($('<option>', {value: value.id,text: value.state}, '</option>'))
                            // $('.' + value.name)[1].prop('required',true);
                        });
                    }
                });
            }
        }






        // Pring Unit Card Function .......

        function printUnitCard(imageUrl, unitType, unitPrice, activationBtn, unitTitle, unitDate, detailsUrl, detailState) {
        var price = ""
        var activation = ""
        if (unitPrice != null) {
            price  = '<label class="price">'+
                '        <span>'+unitPrice+'</span>'+
                '      </label>';
        }
        if (activationBtn != null) {

            if (activationBtn == "not_active") {
                activation =    '      <a href="#" class="download" style="background: #4C8B55;">'+
                            '		        تفعيل'+
                            '      </a>';
            }

        }
        return '<div class="food">'+
'    <div class="cover" style="background-image: url('+imageUrl+')">'+
'      <label>'+
'        <span>'+unitType+'</span>'+
'      </label>'+
      price +
'      <label class="right">'+
'        <span>'+detailState+'</span>'+
'      </label>'+
'    </div>'+
'    <div class="info">'+
'      <a href="'+detailsUrl+'" class="recipe">'+
'        <i>'+
'          <svg x="0px" y="0px" width="26px" height="28px"'+
'>'+
'	          <g>'+
'		          <path d="M 8.5 20 L 8.5 21 L 17.5 21 L 17.5 20 L 8.5 20 ZM 8.5 16 L 8.5 17 L 17.5 17 L 17.5 16 L 8.5 16 ZM 8.5 12 L 8.5 13 L 17.5 13 L 17.5 12 L 8.5 12 ZM 20 0 C 19.4477 0 19 0.4477 19 1 L 19 6 C 19 6.5523 19.4477 7 20 7 C 20.5523 7 21 6.5523 21 6 L 21 1 C 21 0.4477 20.5523 0 20 0 ZM 13 0 C 12.4477 0 12 0.4477 12 1 L 12 6 C 12 6.5523 12.4477 7 13 7 C 13.5523 7 14 6.5523 14 6 L 14 1 C 14 0.4477 13.5523 0 13 0 ZM 6 0 C 5.4477 0 5 0.4477 5 1 L 5 6 C 5 6.5523 5.4477 7 6 7 C 6.5523 7 7 6.5523 7 6 L 7 1 C 7 0.4477 6.5523 0 6 0 ZM 15 4 L 18 4 L 18 3 L 15 3 L 15 4 ZM 8 4 L 11 4 L 11 3 L 8 3 L 8 4 ZM 3 4 L 4 4 L 4 3 L 3 3 C 1.3431 3 0 4.3431 0 6 L 0 25 C 0 26.6569 1.3431 28 3 28 L 23 28 C 24.6569 28 26 26.6569 26 25 L 26 6 C 26 4.3431 24.6569 3 23 3 L 22 3 L 22 4 L 23 4 C 24.1046 4 25 4.8954 25 6 L 25 25 C 25 26.1046 24.1046 27 23 27 L 3 27 C 1.8954 27 1 26.1046 1 25 L 1 6 C 1 4.8954 1.8954 4 3 4 Z" fill="#ffffff"/>'+
'	          </g>'+
'          </svg>'+
'        </i>'+
'        <span>{{trans('frontend.details')}}</span>'+
'      </a>'+
'      <div class="contentt">'+
'            <div class="container">'+
'                <div class="row">'+
'                    '+
'                    <div class="col-md-9 col-sm-9">'+
'                        <div class="date">'+
'                            <span class="date-string">'+unitTitle+'</span>'+
'                            <span class="date-num">'+unitDate+'</span>'+
'                        </div>'+
''+
'                        '+
'                    </div>'+
'                </div>'+
'            </div>'+
'      </div>'+
'    </div>'+
'  </div>';
    }
    });


    </script>







    




@endsection



