@if(Session::has('success'))

    <div class="alert alert-success alert-dismissable text-center">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {{ Session::get('success') }}
    </div>

@endif




@if(Session::has('error'))

    <div class="alert alert-danger alert-dismissable text-center">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {{ Session::get('error') }}
    </div>

@endif