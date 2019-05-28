@extends('control_panel.control_panel_master')

@section('style')

@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('users/providers/branches/exception_working_days/update.work_exception_day') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('exceptionWorkingDays.edit',$exceptionWorkingDay->id) }}">{{ trans('users/providers/branches/exception_working_days/update.update_work_exception_day') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('exceptionWorkingDays.index',$branch->id) }}">{{ trans('users/providers/branches/exception_working_days/update.work_exception_day') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('branches.index',$branch->provider_id) }}">{{ trans('users/providers/branches/exception_working_days/update.Branches') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.providers') }}">{{ trans('users/providers/branches/exception_working_days/update.Providers') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">{{ trans('users/providers/branches/exception_working_days/update.update_work_exception_day') }}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('exceptionWorkingDays.update',$exceptionWorkingDay->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        @include('control_panel.users.provider.branches.exception_working_days._form',['button'=>trans('users/providers/branches/exception_working_days/update.update_work_exception_day')])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        if(document.getElementById('users')){
            document.getElementById('users').classList.add('selected');
        }
    </script>
@endsection