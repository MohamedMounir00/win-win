
<!DOCTYPE html>
@php  $lang = LaravelLocalization::getCurrentLocale();  @endphp



<html lang="{{ $lang }}" dir="{{ $lang == 'ar' ? 'rtl':'ltr' }}">





@include('backend.partials.header')

<!-- /header content -->
<body class="nav-md" style="word-wrap: break-word; font-family: 'Tajawal', sans-serif;">
<div class="container body">
    <div class="main_container">
    @include('backend.partials.sidbar')

    <!-- top navigation -->
        <!-- /top navigation -->
        <!-- /header content -->
    @include('backend.partials.nav')

    <!-- page content -->
        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-12 col-xs-12">



                <!-- Yielding main content -->
                @yield('content')
            </div>
        </div>
        <!-- /page content -->

@include('backend.partials.footer')

    </div>
</div>
</body>
</html>
