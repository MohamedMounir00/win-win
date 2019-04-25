
@extends('frontend.layouts.app')

@section('content')

    @php

        $lang = LaravelLocalization::getCurrentLocale();

    @endphp


    <!-- Datails Section -->

    <div class="row no-gutters">
        <div class="col-md-12">

            <!-- Datails Section -->
            <div class="display-details">

                <!-- Detail Section Header -->
                <div class="container">
                    <div class="detail-header">
                        <div class="row no-gutters">
                            <div class="col-md-8 col-sm-6">
                                <div class="details-title">
                                    <h2>كل واحداتي</h2>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="unit-title">
                                    <span><i class="fa fa-cog" aria-hidden="true"></i> نوع الوحدة</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- User Info Section -->
                <div class="user-info">
                    <div class="container">
                        <div class="row no-gutters">
                            <div class="col-md-2">
                                <div class="user-img">
                                    <img class="img-fluid" src="images/brokerr.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="user-data">
                                    <p id="unit">الوحدة كـ </p>
                                    <h2 id="username">أسم المستخدم</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Units Images -->
                <div class="units-galary">
                    <div class="row no-gutters">
                        <div class="container">
                            <div class="col-md-12">
                                <div class="show-images">
                                    <img class="img-fluid img-thumbnail" src="images/brokerr.jpg"
                                         alt="">
                                    <img class="img-fluid img-thumbnail" src="images/broker2.jpg"
                                         alt="">
                                    <img class="img-fluid img-thumbnail" src="images/brokerr.jpg"
                                         alt="">
                                    <img class="img-fluid img-thumbnail" src="images/broker2.jpg"
                                         alt="">
                                    <img class="img-fluid img-thumbnail" src="images/broker2.jpg"
                                         alt="">
                                    <img class="img-fluid img-thumbnail" src="images/brokerr.jpg"
                                         alt="">
                                    <img class="img-fluid img-thumbnail" src="images/broker2.jpg"
                                         alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistcs -->
                <div class="statistics text-center">
                    <div class="container">
                        <div class="statt">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <div class="state">
                                        <i class="fa fa-check"></i>
                                        <p>بيع  / إيجار</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="state">
                                        <span>القاهرة</span>
                                        <p>المدينة</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="state">
                                        <span>مدينة نصر</span>
                                        <p>المحافظة</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="state">
                                        <i class="fa fa-check"></i>
                                        <p>التشطيب</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





                <!-- Statistcs -->
                <div class="statistics text-center">
                    <div class="container">
                        <div class="statt">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <div class="state">
                                        <span>8 متر</span>
                                        <p>المساحة</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="state">
                                        <span>8</span>
                                        <p>الدور</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="state">
                                        <span>2</span>
                                        <p>الحمامات</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="state">
                                        <span>2450 ج م</span>
                                        <p>السعر</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Descripton -->
                <div class="container">
                    <div class="description">
                        <div class="row no-gutters">
                            <div class="col-sm-12">
                                <h2>الوصف</h2>
                                <p>نحن شركة تسعي إلي سهولة البحث عن جميع أنواع العقارات من شقق وعمارات وأراضي وكل ما يحتاجه الأخشخاص</p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Buttons -->
                <div class="action-btn">
                    <div class="container">
                        <div class="row no-gutters">
                            <div class="col-sm-12">
                                <button class=" blue btn btn-primary"><i class="fa fa-check"
                                                                         aria-hidden="true"></i> الوحدات المتاحة</button>
                                <button class="btn btn-secondary"><i class="fa fa-pencil"
                                                                     aria-hidden="true"></i> تعديل الوحدة</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
