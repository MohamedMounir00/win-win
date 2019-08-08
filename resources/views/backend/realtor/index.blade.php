@extends('backend.layouts.app')
@section('page_title' , trans('backend.realtor'))

@section('content')

    <div class="x_panel">
            <div class="x_title">
                <h2>{{trans('backend.realtor')}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

             


                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">

                <table id="table1" class="table table-striped table-bordered bulk_action table1">
                    <thead>
                    <tr>
                        <th>{{trans('backend.count_unit')}}</th>
                        <th>{{trans('backend.company_name')}}</th>
                        <th>{{trans('backend.image')}}</th>
                        <th>{{trans('backend.email')}}</th>
                        <th>{{trans('backend.verification')}}</th>
                        <th>{{trans('backend.city')}}</th>
                        <th>{{trans('backend.state')}}</th>
                        <th>{{trans('backend.action')}}</th>

                    </tr>
                    </thead>


                    <tbody>



                    </tbody>
                </table>
                </div>
            </div>
        </div>

  @endsection
@section('scripts')

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script>
        $(function() {
            $('#table1').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('realtor.get_realtor') !!}',
                columns: [
                    { data: 'count', name: 'count' },
                    { data: 'company_name', name: 'company_name' },
                    { data: 'image', name: 'image' } ,
                    { data: 'email', name: 'email' },
                    { data: 'active', name: 'active' },
                    { data: 'city', name: 'city' },
                    { data: 'state', name: 'state' },

                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ],
                "language": {
                    "decimal": "",
                    "emptyTable": "{{trans('backend.No_data_available_in_table')}}",
                    "infoEmpty": "{{trans('backend.Showing_0_to_0_of_0_entries')}}",
                    "info":           "{{trans('backend.showing')}}_START_ {{trans('backend.to')}} _END_ {{trans('backend.of')}} _TOTAL_{{trans('backend.entries')}} ",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "{{trans('backend.show_t')}}_MENU_ {{trans('backend.entries')}}",
                    "search": "{{trans('backend.search')}}",
                    "zeroRecords": "{{trans('backend.No_matching_records_found')}}",
                    "processing":     "{{trans('backend.processing')}}",

                    "paginate": {
                        "first": "{{trans('backend.First')}}",
                        "last": "{{trans('backend.Last')}}",
                        "next": "{{trans('backend.Next')}}",
                        "previous": "{{trans('backend.Previous')}}"
                    }

                }
            });
        });
    </script>
    <script>
        $('#table1').on('click', '.btn-delete[data-remote]', function (e) {
            e.preventDefault();
          ;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var url = $(this).data('remote');



            swal({
                title: "{{trans('backend.ask_delete')}}",
                type: "warning",
                buttons: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                buttons: ['{{trans('backend.no')}}', '{{trans('backend.yes')}}'],

                closeOnConfirm: false
            }).then(function(yes) {
                if (yes) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: '_DELETE', submit: true}
                    }).always(function (data) {
                        $('#table1').DataTable().draw(false);
                    });
                }
                else {
                    return false;
                }
            })

        })
    </script>
    <script>
        $('#table1').on('click', '.btn-active[data-remote]', function (e) {
            e.preventDefault();
            ;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var url = $(this).data('remote');



            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'json',
                data: {method: '_DELETE', submit: true}
            }).always(function (data) {
                $('#table1').DataTable().draw(false);
            });

        })
    </script>
@endsection
