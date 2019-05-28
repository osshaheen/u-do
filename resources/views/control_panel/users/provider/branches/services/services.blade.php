@extends('control_panel.control_panel_master')

@section('style')
    <link href="{{asset('/control_panel/assets/node_modules/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/control_panel/assets/node_modules/switchery/dist/switchery.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/control_panel/assets/node_modules/bootstrap-switch/bootstrap-switch.min.css')}}" rel="stylesheet">
    <link href="{{asset('/control_panel/dist/css/pages/bootstrap-switch.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('users/providers/branches/services/services.Services') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                @if(!$trashTrigger)
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('services.index',$branch->id) }}">{{ trans('users/providers/branches/services/services.Services') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('branches.index',$branch->provider_id) }}">{{ trans('users/providers/branches/services/services.Branches') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.providers') }}">{{ trans('users/providers/branches/services/services.Providers') }}</a></li>
                </ol>
                    <a href="{{ route('services.create',$branch->id) }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i>{{ trans('users/providers/branches/services/services.Create_Service') }}</a>
                    <a href="{{ route('services.trashed',$branch->id) }}" class="btn btn-danger d-none d-lg-block m-l-15"><i class="fa fa-trash"></i>{{ trans('users/providers/branches/services/services.Trashed_Services') }}</a>
                @else
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('services.trashed',$branch->id) }}">{{ trans('users/providers/branches/services/services.Trashed_Services') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('services.index',$branch->id) }}">{{ trans('users/providers/branches/services/services.Services') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('branches.index',$branch->provider_id) }}">{{ trans('users/providers/branches/services/services.Branches') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.providers') }}">{{ trans('users/providers/branches/services/services.Providers') }}</a></li>
                    </ol>
                @endif
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ trans('users/providers/branches/services/services.Services') }}</h4>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('users/providers/branches/services/services.branch_name') }}</th>
                                    <th>{{ trans('users/providers/branches/services/services.category_name') }}</th>
                                    <th>{{ trans('users/providers/branches/services/services.service_name') }}</th>
                                    <th>{{ trans('users/providers/branches/services/services.service_description') }}</th>
                                    @if(!$trashTrigger)
                                        <th>{{ trans('users/providers/branches/services/services.update') }}</th>
                                        <th>{{ trans('users/providers/branches/services/services.delete') }}</th>
                                    @else
                                        <th>{{ trans('users/providers/branches/services/services.deleted_since') }}</th>
                                        <th>{{ trans('users/providers/branches/services/services.restore') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($branch->services as $service)
                                    <tr>
                                        <td>{{$branch->name}}</td>
                                        <td>{{$service->category->name}}</td>
                                        <td><a href="{{ route('services.tags',$service->id) }}">{{$service->name}}</a></td>
                                        <td>{{$service->description}}</td>
                                        @if(!$trashTrigger)
                                        <td>
                                            <a href="{{ route('services.edit',$service->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('services.destroy',$service->id) }}" method="post" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @else
                                        <td>
                                            {{ $service->deleted_since }}
                                        </td>
                                        <td>
                                            <a href="{{ route('services.restore',$service->id) }}" class="btn btn-warning"><i class="fa fa-arrow-circle-o-left"></i></a>
                                        </td>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- This is data table -->
    <script src="{{asset('/control_panel/assets/node_modules/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script src="{{asset('/control_panel/assets/node_modules/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('/control_panel/assets/node_modules/switchery/dist/switchery.min.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
        });
        if(document.getElementById('providers')){
            document.getElementById('providers').classList.add('selected');
        }

        function change_provider_rank(obj,provider_id) {
            var rank_id = obj.value;
            swal({
                title: "Are you sure?",
                text: "You will change provider rank",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, change it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    $.get('/change_provider_rank/'+provider_id+'/'+rank_id , function (data, status) {
                        console.log(data);
                        swal("Changed!", "Provider rank is been changed.", "success");
                    });
                } else {
                    swal("Cancelled", "Provider rank is safe :)", "error");
                }
            });
        };
        function change_provider_service_type(obj,provider_id) {
            var provider_service_type = obj.value;
            swal({
                title: "Are you sure?",
                text: "You will change provider service type",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, change it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    $.get('/change_provider_service_type/'+provider_id+'/'+provider_service_type , function (data, status) {
                        console.log(data);
                        swal("Changed!", "Provider service type is been changed.", "success");
                    });
                } else {
                    swal("Cancelled", "Provider service type is safe :)", "error");
                }
            });
        };
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    "columnDefs": [{
                        "visible": false,
                        "targets": 2
                    }],
                    "order": [
                        [2, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                        table.order([2, 'desc']).draw();
                    } else {
                        table.order([2, 'asc']).draw();
                    }
                });
            });
        });
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    </script>
@endsection