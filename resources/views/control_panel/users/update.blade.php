@extends('control_panel.control_panel_master')

@section('style')

@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('users/update.users_title') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('users.edit',$user->id) }}">{{ trans('users/update.update_user') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ trans('users/update.users_title') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">{{ trans('users/update.update_user') }}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        @include('control_panel.users._form',['button'=>'update user'])
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