@extends('control_panel.control_panel_master')

@section('style')
    <link href="{{asset('/control_panel/assets/node_modules/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/control_panel/assets/node_modules/switchery/dist/switchery.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/control_panel/assets/node_modules/bootstrap-switch/bootstrap-switch.min.css')}}" rel="stylesheet">
    <link href="{{asset('/control_panel/dist/css/pages/bootstrap-switch.css')}}" rel="stylesheet">
    <style>
        .hover-anchor:hover{
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">{{ trans('users/providers/branches/work_days.work_day_data') }}</h4>
                            </div>
                            <div class="modal-body" id="modal_body">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" onclick="document.getElementById('responsive-modal').style.display = 'none';document.getElementById('responsive-modal').classList.add('fade');">{{ trans('users/providers/branches/work_days.Close') }}</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light" onclick="set_work_day_customization()">{{ trans('users/providers/branches/work_days.Save_changes') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('users/providers/branches/work_days.work_day_data') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('branches.work_days',$branch->id) }}">{{ trans('users/providers/branches/work_days.work_days') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('branches.index',$branch->provider_id) }}">{{ trans('users/providers/branches/work_days.Branches') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.providers') }}">{{ trans('users/providers/branches/work_days.Providers') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ trans('users/providers/branches/work_days.Branches') }}</h4>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>{{ trans('users/providers/branches/work_days.Name') }}</th>
                                    <th>{{ trans('users/providers/branches/work_days.provider') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $branch->name }}</td>
                                    <td>{{ $branch->provider->name }}</td>
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
                    <h4 class="card-title">week days</h4>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <th>
                                    {{ trans('users/providers/branches/work_days.select') }}
                                </th>
                                <th>
                                    {{ trans('users/providers/branches/work_days.day') }}
                                </th>
                            </thead>
                            <tbody>
                                @foreach($week_days as $week_day)
                                <tr>
                                    <td>
                                        <input type="checkbox" @if($week_day->calendar_count) checked @endif class="js-switch" data-color="#26c6da" onchange="addWeekDayToCalendar(this,'{{$week_day->id}}')"/>
                                    </td>
<!--                                    --><?php //dd($week_day->calendar->count());?>
                                    <td><a class="hover-anchor" onclick="week_day_customization('{{$week_day->calender_pivot_object}}')">{{$week_day->day}}</a></td>
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
    <script src="{{asset('/control_panel/assets/node_modules/switchery/dist/switchery.min.js')}}"></script>
    <script>
        function week_day_customization(week_day) {
            week_day = JSON.parse(week_day);
            document.getElementById('modal_body').innerHTML = '\n' +
                '                                <div class="form-group">\n' +
                '                                    <label for="max_number" class="control-label">'+'{{ trans('users\\providers\\branches\\work_days.max_number_of_orders') }}'+'</label>\n' +
                '                                    <input type="number" value="'+week_day.max_number+'" class="form-control" id="max_number">\n' +
                '                                </div>\n' +
                '                                <div class="form-group">\n' +
                '                                    <label for="from" class="control-label">'+'{{ trans('users\\providers\\branches\\work_days.from') }}'+'</label>\n' +
                '                                    <input type="time" value="'+week_day.from+'" class="form-control" id="from">\n' +
                '                                </div>'+
                '                                <div class="form-group">\n' +
                '                                    <label for="to" class="control-label">'+'{{ trans('users\\providers\\branches\\work_days.to') }}'+'</label>\n' +
                '                                    <input type="time" value="'+week_day.to+'" class="form-control" id="to">\n' +
                '                                    <input type="hidden" value="'+week_day.id+'" class="form-control" id="work_day_id">\n' +
                '                                </div>';
            document.getElementById('responsive-modal').style.display = 'block';
            document.getElementById('responsive-modal').classList.remove('fade');
        }
        function set_work_day_customization(){
            var form_data = new FormData();
            form_data.append('_token', "{{ csrf_token() }}");
            // form_data.append('shape',JSON.stringify(shape, getCircularReplacer()));
            form_data.append('max_number',document.getElementById('max_number').value);
            form_data.append('from',document.getElementById('from').value);
            form_data.append('to',document.getElementById('to').value);
            form_data.append('work_day_id',document.getElementById('work_day_id').value);

            $.ajax(
                {
                    url: "{{route('branches.set_work_day_customization')}}", // point to server-side PHP script
                    // dataType: 'text',  // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (data, status) {
                        document.getElementById('max_number').value = data.max_number;
                        document.getElementById('from').value = data.from;
                        document.getElementById('to').value = data.to;
                    }
                });
            document.getElementById('responsive-modal').style.display = 'none';
            document.getElementById('responsive-modal').classList.add('fade');
        }
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
        function addWeekDayToCalendar(obj,week_day_id){
            var status = 0;
            obj.checked === true ? status = 1 : status = 0;
            $.get('/addWeekDayToCalendar/'+'{{$branch->id}}'+'/'+week_day_id+'/'+status , function (data, status) {
                console.log(data);
            });
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