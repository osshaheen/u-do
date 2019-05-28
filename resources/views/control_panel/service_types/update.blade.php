@extends('control_panel.control_panel_master')

@section('style')

@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('service_types/update.Service_types') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('service_types.edit',$service_type->id) }}">{{ trans('service_types/update.Update_Service_type') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('service_types.index') }}">{{ trans('service_types/update.Service_types') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">{{ trans('service_types/update.Update_Service_type') }}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('service_types.update',$service_type->id) }}">
                        @method('put')
                        @csrf
                        @include('control_panel.service_types._form',['button'=>trans('service_types/update.Update_Service_type')])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        if(document.getElementById('service_types')){
            document.getElementById('service_types').classList.add('selected');
        }
    </script>
@endsection