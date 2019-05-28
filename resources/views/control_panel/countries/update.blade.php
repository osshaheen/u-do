@extends('control_panel.control_panel_master')

@section('style')

@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('countries/update.countries_title') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('countries.edit',$country->id) }}">{{ trans('countries/update.update_country') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('countries.index') }}">{{ trans('countries/update.countries_title') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">{{ trans('countries/update.update_country') }}<</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('countries.update',$country->id) }}">
                        @method('put')
                        @csrf
                        @include('control_panel.countries._form',['button'=>'Update country'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        if(document.getElementById('countries')){
            document.getElementById('countries').classList.add('selected');
        }
    </script>
@endsection