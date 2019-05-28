@extends('control_panel.control_panel_master')

@section('style')

@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('users/providers/branches/update.Branches') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('branches.edit',$branch->provider_id) }}">{{ trans('users/providers/branches/update.Update_Branch') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('branches.index',$branch->provider_id) }}">{{ trans('users/providers/branches/update.Branches') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.providers') }}">{{ trans('users/providers/branches/update.Providers') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">{{ trans('users/providers/branches/update.Update_Branch') }}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('branches.update',$branch->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        @include('control_panel.users.provider.branches._form',['button'=>trans('users/providers/branches/update.Update_Branch')])
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