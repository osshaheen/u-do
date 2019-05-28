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
            <h4 class="text-themecolor">{{ trans('users/providers/providers.Providers') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('users.providers') }}">{{ trans('users/providers/providers.Providers') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ trans('users/providers/providers.Providers') }}</h4>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('users/providers/providers.UserName') }}</th>
                                    <th>{{ trans('users/providers/providers.provider_name') }}</th>
                                    <th>{{ trans('users/providers/providers.provider_bio') }}</th>
                                    <th>{{ trans('users/providers/providers.provider_branches') }}</th>
                                    <th>{{ trans('users/providers/providers.provider_rank') }}</th>
                                    <th>{{ trans('users/providers/providers.provider_service_type') }}</th>
                                    <th>{{ trans('users/providers/providers.update') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($providers as $provider)
                                    <tr>
                                        <td>{{$provider->username}}</td>
                                        <td>{{$provider->name}}</td>
                                        <td>{{$provider->bio}}</td>
                                        <td><a href="{{ route('branches.index',$provider->id) }}">branches</a></td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" onchange="change_provider_rank(this,'{{$provider->id}}')">
                                                    <option value="null"></option>
                                                    @foreach($ranks as $rank)
                                                        <option value="{{ $rank->id }}" @if($rank->id == $provider->rank_id) selected @endif>{{ $rank->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" onchange="change_provider_service_type(this,'{{$provider->id}}')">
                                                    <option value="null"></option>
                                                    @foreach($service_types as $service_type)
                                                        <option value="{{ $service_type->id }}" @if($service_type->id == $provider->service_type_id) selected @endif>{{ $service_type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('users.provider.edit',['provider_id'=>$provider->id,'trigger'=>0]) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        </td>
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