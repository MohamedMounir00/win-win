@extends('backend.layouts.app')

@section('page_title' , trans('backend.role'))

@section('breadcrumb')


    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">{{ trans('backend.role') }}</h4>
    </div>


@endsection


@section('content')

    <div class="col-sm-12">
        <div class="white-box">
            {{-- <h3 class="box-title m-b-0">Bordered Table</h3>
            <p class="text-muted m-b-20">Add<code>.table-bordered</code>for borders on all sides of the table and cells.</p> --}}
            <div class="table-responsive">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>{{ trans('backend.role') }}</h2>
                        </div>

                        <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('roles.create') }}"> {{ trans('backend.add') }}</a>
                        </div>
                    </div>
                </div>





                <table class="table table-bordered" >
                    <tr>
                        <th>{{ trans('backend.name') }}</th>
                        <th width="280px">{{trans('backend.action')}}</th>
                    </tr>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ $role->name }}</td>

                            <td>
                                @if($role->name !='admin')

                                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">{{ trans('backend.show') }}</a>
                                @can('role-edit')
                                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">{{ trans('backend.edit') }}</a>
                                @endcan
                                @can('role-delete')

                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}

                                    {!! Form::submit(trans('backend.delete'), ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @endif

                            </td>
                        </tr>
                    @endforeach
                </table>


            </div>
        </div>
    </div>


@endsection
@section('scripts')



    <script>

        function ConfirmDelete()
        {
            var x = confirm("'هل انت متاكد من حذف هذه الصلاحيه؟'");
            if (x)
                return true;
            else
                return false;
        }

    </script>
 
@endsection

