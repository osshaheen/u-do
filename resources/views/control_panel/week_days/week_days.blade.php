@extends('control_panel.control_panel_master')

@section('style')
    <link href="{{asset('/control_panel/assets/node_modules/switchery/dist/switchery.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/control_panel/assets/node_modules/bootstrap-switch/bootstrap-switch.min.css')}}" rel="stylesheet">
    <link href="{{asset('/control_panel/dist/css/pages/bootstrap-switch.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('week_days/week_days.week_days') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                @if(!$trashTrigger)
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('weekDays.index') }}">{{ trans('week_days/week_days.week_days') }}</a></li>
                </ol>
                    <a href="{{ route('weekDays.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i>{{ trans('week_days/week_days.week_days') }}</a>
                    <a href="{{ route('weekDays.trashed') }}" class="btn btn-danger d-none d-lg-block m-l-15"><i class="fa fa-trash"></i>{{ trans('week_days/week_days.Trashed_week_days') }}</a>
                @else
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('weekDays.trashed') }}">{{ trans('week_days/week_days.Trashed_week_days') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('weekDays.index') }}">{{ trans('week_days/week_days.week_days') }}</a></li>
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
                    <h4 class="card-title">{{ trans('week_days/week_days.week_days') }}</h4>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('week_days/week_days.day') }}</th>
                                    @if($trashTrigger)
                                        <th>
                                            {{ trans('week_days/week_days.day') }}
                                        </th>
                                        <th>
                                            {{ trans('week_days/week_days.restore') }}
                                        </th>
                                    @else
                                        <th>{{ trans('week_days/week_days.update') }}</th>
                                        <th>{{ trans('week_days/week_days.delete') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($weekDays as $weekDay)
                                    <tr>
                                        <td>{{$weekDay->day}}</td>
                                        @if($trashTrigger)
                                            <td>
                                                {{ $weekDay->deleted_since }}
                                            </td>
                                        @endif
                                        @if(!$trashTrigger)
                                            <td>
                                                <a href="{{ route('weekDays.edit',$weekDay->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            </td>
                                            <td>
                                                <form action="{{ route('weekDays.destroy',$weekDay->id) }}" method="post" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ route('weekDays.restore',$weekDay->id) }}" class="btn btn-warning"><i class="fa fa-arrow-circle-o-left"></i></a>
                                            </td>
                                        @endif
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
    <script src="{{asset('/control_panel/assets/node_modules/switchery/dist/switchery.min.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
        });
        if(document.getElementById('weekDays')){
            document.getElementById('weekDays').classList.add('selected');
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