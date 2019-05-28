    <div class="form-body">
        <h3 class="card-title">{{ trans('point_types/form.Point_types_Basic_Info') }}</h3>
        <hr>
        <div class="row p-t-20">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('points') ? 'has-danger' : '' }}">
                    <label class="control-label">{{ trans('point_types/form.points') }}</label>
                    <input type="text" id="Points" name="points" class="form-control {{ $errors->has('points') ? 'form-control-danger' : '' }}" value="{{ old('points',$point_type->points) }}" placeholder="{{ trans('point_types/form.points') }}" >
                    @if($errors->has('points'))
                        <small class="form-control-feedback"> {{ $errors->first('points') }} </small>
                    @endif
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name_en') ? 'has-danger' : '' }}">
                    <label class="control-label">Name</label>
                    <input type="text" id="Name" name="name_en" class="form-control {{ $errors->has('name_en') ? 'form-control-danger' : '' }}" value="{{ old('name_en',$point_type->name_en) }}" placeholder="Name" >
                    @if($errors->has('name_en'))
                        <small class="form-control-feedback"> {{ $errors->first('name_en') }} </small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name_ar') ? 'has-danger' : '' }}">
                    <label class="control-label">الاسم</label>
                    <input type="text" id="Name_ar" name="name_ar" class="form-control {{ $errors->has('name_ar') ? 'form-control-danger' : '' }}" value="{{ old('name_ar',$point_type->name_ar) }}" placeholder="الاسم" >
                    @if($errors->has('name_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('name_ar') }} </small>
                    @endif
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('description_en') ? 'has-danger' : '' }}">
                    <label class="control-label">Description</label>
                    <textarea type="text" id="description_en" name="description_en" rows="5" class="form-control {{ $errors->has('description_en') ? 'form-control-danger' : '' }}" placeholder="Description" >{{ old('description_en',$point_type->description_en) }}</textarea>
                    @if($errors->has('description_en'))
                        <small class="form-control-feedback"> {{ $errors->first('description_en') }} </small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('description_ar') ? 'has-danger' : '' }}">
                    <label class="control-label">الوصف</label>
                    <textarea type="text" id="description_ar" name="description_ar" rows="5" class="form-control {{ $errors->has('description_ar') ? 'form-control-danger' : '' }}" placeholder="الوصف" >{{ old('description_ar',$point_type->description_ar) }}</textarea>
                    @if($errors->has('description_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('description_ar') }} </small>
                    @endif
                </div>
            </div>
            <!--/span-->
        </div>
    </div>
    <input type="hidden" value="{{ $point_type->id }}" name="id">
    <div class="form-actions">
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ $button }}</button>
    </div>
