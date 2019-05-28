@extends('control_panel.control_panel_master')

@section('style')

@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('point_types/update.Point_types_title') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('point_types.edit',$point_type->id) }}">{{ trans('point_types/update.update_Point_type') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('point_types.index') }}">{{ trans('point_types/update.Point_types_title') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">{{ trans('point_types/update.update_Point_type') }}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('point_types.update',$point_type->id) }}">
                        @method('put')
                        @csrf
                        @include('control_panel.point_types._form',['button'=>trans('point_types/update.update_Point_type')])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        if(document.getElementById('point_types')){
            document.getElementById('point_types').classList.add('selected');
        }
    </script>
@endsection