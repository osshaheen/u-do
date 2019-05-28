    <div class="form-body">
        <h3 class="card-title">{{ trans('countries/form.Country_Basic_Info') }}</h3>
        <hr>
        <div class="row p-t-20">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('name_en') ? 'has-danger' : '' }}">
                    <label class="control-label">{{ trans('countries/form.name_en') }}</label>
                    <input type="text" id="name_en" name="name_en" class="form-control {{ $errors->has('name_en') ? 'form-control-danger' : '' }}" value="{{ old('name_en',$country->name_en) }}" placeholder="{{ trans('countries/form.name_en') }}" >
                    @if($errors->has('name_en'))
                        <small class="form-control-feedback"> {{ $errors->first('name_en') }} </small>
                    @endif
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('name_ar') ? 'has-danger' : '' }}">
                    <label class="control-label">{{ trans('countries/form.name_ar') }}</label>
                    <input type="text" id="name_ar" name="name_ar" class="form-control {{ $errors->has('name_ar') ? 'form-control-danger' : '' }}" value="{{ old('name_ar',$country->name_ar) }}" placeholder="{{ trans('countries/form.name_ar') }}" >
                    @if($errors->has('name_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('name_ar') }} </small>
                    @endif
                </div>
            </div>
            <!--/span-->
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ $button }}</button>
    </div>
