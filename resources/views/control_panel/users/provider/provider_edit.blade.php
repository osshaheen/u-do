@extends('control_panel.control_panel_master')

@section('style')
    <link href="{{asset('/control_panel/assets/node_modules/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('users/providers/provider_edit.edit_provider') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('users.provider.edit',$provider->id) }}">{{ trans('users/providers/provider_edit.edit_provider') }} {{ $provider->user->username }} </a></li>
                    @if($trigger)
                        <li class="breadcrumb-item"><a href="{{ route('users.getProviderDetails',$provider->id) }}">{{ trans('users/providers/provider_edit.edit_provider') }} {{ $provider->user->username }} </a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ trans('users/providers/provider_edit.Users') }}</a></li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ route('users.providers') }}">{{ trans('users/providers/provider_edit.providers') }}</a></li>
                    @endif
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('users.provider.updateUserProvider',$provider->id) }}">
                        @csrf
                        <h4 class="card-title">{{ trans('users/providers/provider_edit.provider') }}</h4>
                        <div class="form-body">
                            @if(count($provider->toArray()))
                                <div class="row p-t-20 justify-content-center">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <img src="{{asset("storage/".$provider->image_path)}}" onclick="uploadFile()" id="mediable_image" style="max-height: 250px;max-width: 250px">
                                            <input type="file" name="image" accept="image/*" class="form-control" onchange="uploadPicture('{{$provider->id}}','App\\Provider')" style="display: none;" id="mediable">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('name_en') ? 'has-danger' : '' }}">
                                        <label class="control-label">Provider Name</label>
                                        <input type="text" id="name_en" name="name_en" class="form-control {{ $errors->has('name_en') ? 'form-control-danger' : '' }}" value="{{ old('name_en',$provider->name_en) }}" placeholder="Name" >
                                        @if($errors->has('name_en'))
                                            <small class="form-control-feedback"> {{ $errors->first('name_en') }} </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('name_ar') ? 'has-danger' : '' }}">
                                        <label class="control-label">اسم المزود</label>
                                        <input type="text" id="name_ar" name="name_ar" class="form-control {{ $errors->has('name_ar') ? 'form-control-danger' : '' }}" value="{{ old('name_ar',$provider->name_ar) }}" placeholder="اسم المزود" >
                                        @if($errors->has('name_ar'))
                                            <small class="form-control-feedback"> {{ $errors->first('name_ar') }} </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('bio_en') ? 'has-danger' : '' }}">
                                        <label class="control-label">bio</label>
                                        <textarea id="bio_en" name="bio_en" rows="5" class="form-control {{ $errors->has('bio_en') ? 'form-control-danger' : '' }}" placeholder="bio" >{{ old('bio_en',$provider->bio_en) }}</textarea>
                                        @if($errors->has('bio_en'))
                                            <small class="form-control-feedback"> {{ $errors->first('bio_en') }} </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('bio_ar') ? 'has-danger' : '' }}">
                                        <label class="control-label">نبذة</label>
                                        <textarea id="bio_ar" name="bio_ar" rows="5" class="form-control {{ $errors->has('bio_ar') ? 'form-control-danger' : '' }}" placeholder="نبذة" >{{ old('bio_ar',$provider->bio_ar) }}</textarea>
                                        @if($errors->has('bio_ar'))
                                            <small class="form-control-feedback"> {{ $errors->first('bio_ar') }} </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $provider->id }}">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> update </button>
                        </div>
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