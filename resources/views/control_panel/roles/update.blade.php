@extends('control_panel.control_panel_master')

@section('style')

@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{trans('roles/update.Roles')}}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('roles.edit',$role->id) }}">{{trans('roles/update.Update_Role')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">{{trans('roles/update.Roles')}}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">{{trans('roles/update.Update_Role')}}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('roles.update',$role->id) }}">
                        @method('put')
                        @csrf
                        @include('control_panel.roles._form',['button'=>trans('roles/update.Update_Role')])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        if(document.getElementById('roles')){
            document.getElementById('roles').classList.add('selected');
        }
    </script>
@endsection