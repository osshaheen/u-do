@extends('control_panel.control_panel_master')

@section('style')

@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('Places/update.Places_title') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('places.edit',$place->id) }}">{{ trans('Places/update.update_Place') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('places.index') }}">{{ trans('Places/update.Places_title') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">{{ trans('Places/update.update_Place') }}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('places.update',$place->id) }}">
                        @method('put')
                        @csrf
                        @include('control_panel.places._form',['button'=>trans('Places/update.update_Place')])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        if(document.getElementById('places')){
            document.getElementById('places').classList.add('selected');
        }
    </script>
@endsection