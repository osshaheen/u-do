@extends('control_panel.control_panel_master')

@section('style')

@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{trans('states/create.States')}}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('states.create') }}">{{trans('states/create.Create_State')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('states.index') }}">{{trans('states/create.States')}}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">{{ trans('states/create.Create_State') }}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('states.store') }}">
                        @csrf
                        @include('control_panel.states._form',['button'=>trans('states/create.Create_State')])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        if(document.getElementById('states')){
            document.getElementById('states').classList.add('selected');
        }
    </script>
@endsection