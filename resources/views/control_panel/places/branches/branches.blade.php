@extends('control_panel.control_panel_master')

@section('style')
    <link href="{{asset('/control_panel/assets/node_modules/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('Places/branches/branches.Place_Branches_title') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                @if(!$trashTrigger)
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('places.show',$place->id) }}">{{ trans('Places/branches/branches.Place_Branches_title') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('places.index') }}">{{ trans('Places/branches/branches.Places') }}</a></li>
                    </ol>
                    <a href="{{ route('places.branch.create',$place->id) }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> {{ trans('Places/branches/branches.Create_Place_Branch') }}</a>
                    <a href="{{ route('places.branch.trashed',$place->id) }}" class="btn btn-danger d-none d-lg-block m-l-15"><i class="fa fa-trash"></i> {{ trans('Places/branches/branches.Trashed_Place_Branches') }}</a>
                @else
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('places.branch.trashed',$place->id) }}">{{ trans('Places/branches/branches.Trashed_Place_Branches') }}</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('places.show',$place->id) }}">{{ trans('Places/branches/branches.Place_Branches_title') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('places.index') }}">{{ trans('Places/branches/branches.Places') }}</a></li>
                    </ol>
                @endif
            </div>
        </div>
        {{--<div class="col-md-7 align-self-center text-right">--}}
            {{--<div class="d-flex justify-content-end align-items-center">--}}
                {{--<ol class="breadcrumb">--}}
                    {{--<li class="breadcrumb-item active"><a href="{{ route('places.show',$place->id) }}">Place Branches</a></li>--}}
                    {{--<li class="breadcrumb-item"><a href="{{ route('places.index') }}">Places</a></li>--}}
                {{--</ol>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ trans('Places/branches/branches.Place') }}</h4>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>{{ trans('Places/branches/branches.name') }}</th>
                                    <th>{{ trans('Places/branches/branches.bio') }}</th>
                                    <th>{{ trans('Places/branches/branches.service_type') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $place->name }}</td>
                                    <td>{{ $place->bio }}</td>
                                    <td>{{ $place->service_type->name }}</td>
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
                    <h4 class="card-title">{{ trans('Places/branches/branches.Branches_title') }}</h4>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <th>
                                    {{ trans('Places/branches/branches.name') }}
                                </th>
                                @if($trashTrigger)
                                    <th>
                                        {{ trans('Places/branches/branches.deleted_since') }}
                                    </th>
                                @else
                                    <th>
                                        {{ trans('Places/branches/branches.main') }}
                                    </th>
                                @endif
                                <th>{{ trans('Places/branches/branches.address') }}</th>
                                <th>{{ trans('Places/branches/branches.operations') }}</th>
                            </thead>
                            <tbody>
                                @foreach($place->branches as $branch)
                                <tr>
                                    <td>{{$branch->name}}</td>
                                    @if($trashTrigger)
                                        <td>
                                            {{ $branch->deleted_since }}
                                        </td>
                                    @else
                                        <td><?=$branch->is_main_tag?></td>
                                    @endif
                                    <td>
                                        <a href="{{ route('places.branch.addAddress',$branch->id) }}">address</a>
                                    </td>
                                    <td>
                                        @if(!$trashTrigger)
                                            <a href="{{ route('placesBranch.edit',$branch->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('placesBranch.destroy',$branch->id) }}" method="post" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        @else
                                            <a href="{{ route('places.branch.restore',$branch->id) }}" class="btn btn-warning"><i class="fa fa-arrow-circle-o-left"></i></a>
                                        @endif
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