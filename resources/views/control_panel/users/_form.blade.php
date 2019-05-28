    <div class="form-body">
        <h3 class="card-title">{{ trans('users/form.User_Basic_Info') }}</h3>
        <hr>
        @if(count($user->toArray()))
        <div class="row p-t-20 justify-content-center">
            <div class="col-md-4">
                <div class="form-group">
                    <img src="{{asset("storage/".$user->image_path)}}" onclick="uploadFile()" id="mediable_image" style="max-height: 250px;max-width: 250px">
                    <input type="file" name="image" accept="image/*" class="form-control" onchange="uploadPicture('{{$user->id}}','App\\User')" style="display: none;" id="mediable">
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('username_en') ? 'has-danger' : '' }}">
                    <label class="control-label">name</label>
                    <input type="text" id="username_en" name="username_en" class="form-control {{ $errors->has('username_en') ? 'form-control-danger' : '' }}" value="{{ old('username_en',$user->username_en) }}" placeholder="name" >
                    @if($errors->has('username_en'))
                        <small class="form-control-feedback"> {{ $errors->first('username_en') }} </small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('username_ar') ? 'has-danger' : '' }}">
                    <label class="control-label">الاسم</label>
                    <input type="text" id="username_ar" name="username_ar" class="form-control {{ $errors->has('username_ar') ? 'form-control-danger' : '' }}" value="{{ old('username_ar',$user->username_ar) }}" placeholder="الاسم" >
                    @if($errors->has('username_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('username_ar') }} </small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('phone') ? 'has-danger' : '' }}">
                    <label class="control-label">{{ trans('users/form.phone') }}</label>
                    <input type="text" name="phone" class="form-control {{ $errors->has('phone') ? 'form-control-danger' : '' }}" value="{{ old('phone',$user->phone) }}" placeholder="{{ trans('users/form.phone') }}" >
                    @if($errors->has('phone'))
                        <small class="form-control-feedback"> {{ $errors->first('phone') }} </small>
                    @endif
                </div>
            </div>
        </div>
        <!--/row-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('language') ? 'has-danger' : '' }}">
                    <label class="control-label">{{ trans('users/form.language') }}</label>
                    <select name="language" class="form-control custom-select {{ $errors->has('language') ? 'form-control-danger' : '' }}">
                        <option value="ar" selected>Arabic</option>
                        <option value="en" @if($user->language == 'en') selected @endif>English</option>
                    </select>
                </div>
                @if($errors->has('language'))
                    <small class="form-control-feedback"> {{ $errors->first('language') }} </small>
                @endif
            </div>
            <!--/span-->
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('email') ? 'has-danger' : '' }}">
                    <label class="control-label">{{ trans('users/form.Email') }}</label>
                    <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'form-control-danger' : '' }}" value="{{ old('email',$user->email) }}" placeholder="{{ trans('users/form.Email') }}" autocomplete="off">
                    @if($errors->has('email'))
                        <small class="form-control-feedback"> {{ $errors->first('email') }} </small>
                    @endif
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row p-t-20">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('password') ? 'has-danger' : '' }}">
                    <label class="control-label">{{ trans('users/form.password') }}</label>
                    <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'form-control-danger' : '' }}"  placeholder="{{ trans('users/form.password') }}"  autocomplete="new-password">
                    @if($errors->has('password'))
                        <small class="form-control-feedback"> {{ $errors->first('password') }} </small>
                    @endif
                </div>
            </div>
            <!--/span-->
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-danger' : '' }}">
                    <label class="control-label">{{ trans('users/form.Confirm_Password') }}</label>
                    <input type="password" id="password-confirm" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'form-control-danger' : '' }}"  placeholder="{{ trans('users/form.Confirm_Password') }}"  autocomplete="new-password">
                    @if($errors->has('password_confirmation'))
                        <small class="form-control-feedback"> {{ $errors->first('password_confirmation') }} </small>
                    @endif
                </div>
            </div>
            <!--/span-->
        </div>
        <!--/row-->
        <h3 class="box-title m-t-40">Provider</h3>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>provider name</label>
                    <input type="text" name="provider_name_en" class="form-control {{ $errors->has('provider_name_en') ? 'form-control-danger' : '' }}" value="{{ old('provider_name_en',$user->provider_name_en) }}" placeholder="provider name">
                    @if($errors->has('provider_name_en'))
                        <small class="form-control-feedback"> {{ $errors->first('provider_name_en') }} </small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" name="provider_name_ar" class="form-control {{ $errors->has('provider_name_ar') ? 'form-control-danger' : '' }}" value="{{ old('provider_name_ar',$user->provider_name_ar) }}" placeholder="اسم المزود">
                    @if($errors->has('provider_name_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('provider_name_ar') }} </small>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $user->id }}">
    <div class="form-actions">
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ $button }}</button>
    </div>
