<!-- footer content -->
<footer class="hidden-print">
    <div class="pull-left">
      {{trans('backend.footer')}}
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
<div id="lock_screen">
    <table>
        <tr>
            <td>
                <div class="clock"></div>
                <span class="unlock">
                    <span class="fa-stack fa-5x">
                      <i class="fa fa-square-o fa-stack-2x fa-inverse"></i>
                      <i id="icon_lock" class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                </span>
            </td>
        </tr>
    </table>
</div>

<!-- jQuery -->
<script src="{{asset('vendors')}}/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('vendors')}}/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<!-- NProgress -->
<!-- bootstrap-progressbar -->
<!-- iCheck -->

<!-- bootstrap-daterangepicker -->
<script src="{{asset('vendors')}}/moment/min/moment.min.js"></script>

<script src="{{asset('vendors')}}/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="{{asset('vendors')}}/select2/dist/js/select2.full.min.js"></script>
<script src="{{asset('vendors')}}/validator/validator.js"></script>

<!-- Custom Theme Scripts -->
</script><script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>

<!-- Include this after the sweet alert js file -->

<!-- Chart.js -->
<!-- jQuery Sparklines -->
@if($lang == "ar")

<script src="{{asset('build')}}/js/custom.js"></script>
@else
    <script src="{{asset('build2')}}/js/custom.min.js"></script>
    @endif

   <script src="{{asset('js')}}/swetalert.js"></script>
<script></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('sweet::alert')

@yield('scripts')

