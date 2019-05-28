@extends('control_panel.control_panel_master')

@section('style')
    <link href="{{asset('/control_panel/assets/node_modules/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('users/providers/provider_details.Provider_Details') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('users.getProviderDetails',$provider->id) }}">{{ $provider->user->username }} {{ trans('users/providers/provider_details.Provider_Details') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ trans('users/providers/provider_details.Users') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ trans('users/providers/provider_details.Provider_Details') }}</h4>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>{{ trans('users/providers/provider_details.Name') }}</th>
                                    <th>{{ trans('users/providers/provider_details.Bio') }}</th>
                                    <th>{{ trans('users/providers/provider_details.ranks') }}</th>
                                    <th>{{ trans('users/providers/provider_details.service_type') }}</th>
                                    <th>{{ trans('users/providers/provider_details.edit') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $provider->name }}</td>
                                    <td>{{ $provider->bio }}</td>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control" id="provider_rank">
                                                <option value="null"></option>
                                                @foreach($ranks as $rank)
                                                    <option value="{{ $rank->id }}" @if($rank->providers_count) selected @endif>{{ $rank->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control" id="provider_service_type">
                                                <option value="null"></option>
                                                @foreach($service_types as $service_type)
                                                    <option value="{{ $service_type->id }}" @if($service_type->providers_count) selected @endif>{{ $service_type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('users.provider.edit',$provider->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ trans('users/providers/provider_details.views') }}</h4>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <th>
                                    {{ trans('users/providers/provider_details.username') }}
                                </th>
                                <th>
                                    {{ trans('users/providers/provider_details.view_since') }}
                                </th>
                            </thead>
                            <tbody>
                                @foreach($provider->views as $view)
                                <tr>
                                    <td>{{$view->username}}</td>
                                    <td>{{$view->view_created_at}}</td>
                                </tr>
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
    <script src="{{asset('/control_panel/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('/control_panel/assets/node_modules/popper/popper.min.js')}}"></script>
    <script src="{{asset('/control_panel/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('/control_panel/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('/control_panel/dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('/control_panel/dist/js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('/control_panel/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{asset('/control_panel/assets/node_modules/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('/control_panel/dist/js/custom.min.js')}}"></script>
    <!-- This is data table -->
    <script src="{{asset('/control_panel/assets/node_modules/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/control_panel/assets/node_modules/sweetalert/sweetalert.min.js')}}"></script>
{{--    <script src="{{asset('/control_panel/assets/node_modules/sweetalert/jquery.sweet-alert.custom.js')}}"></script>--}}
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
        if(document.getElementById('users')){
            document.getElementById('users').classList.add('selected');
        }
        document.getElementById('provider_rank').addEventListener('change',function (e) {
            var rank_id = this.value;
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
                    $.get('/change_provider_rank/'+'{{$provider->id}}'+'/'+rank_id , function (data, status) {
                        console.log(data);
                        swal("Changed!", "Provider rank is been changed.", "success");
                    });
                } else {
                    swal("Cancelled", "Provider rank is safe :)", "error");
                }
            });
        });
        document.getElementById('provider_service_type').addEventListener('change',function (e) {
            var provider_service_type = this.value;
            // console.log(this.value);
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
                    $.get('/change_provider_service_type/'+'{{$provider->id}}'+'/'+provider_service_type , function (data, status) {
                        console.log(data);
                        swal("Changed!", "Provider service type is been changed.", "success");
                    });
                } else {
                    swal("Cancelled", "Provider service type is safe :)", "error");
                }
            });
        });

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