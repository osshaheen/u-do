@extends('control_panel.control_panel_master')

@section('style')

@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('week_days/update.week_day') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('weekDays.edit',$weekDay->id) }}">{{ trans('week_days/update.update_week_day') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('weekDays.index') }}">{{ trans('week_days/update.week_day') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">{{ trans('week_days/update.update_week_day') }}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('weekDays.update',$weekDay->id) }}">
                        @method('put')
                        @csrf
                        @include('control_panel.week_days._form',['button'=>trans('week_days/update.update_week_day')])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        if(document.getElementById('weekDays')){
            document.getElementById('weekDays').classList.add('selected');
        }
    </script>
@endsection