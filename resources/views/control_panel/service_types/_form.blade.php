    <div class="form-body">
        <h3 class="card-title">{{trans('service_types/form.Service_types_Basic_Info')}}</h3>
        <hr>
        <div class="row p-t-20">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name_en') ? 'has-danger' : '' }}">
                    <label class="control-label">Name</label>
                    <input type="text" id="name_en" name="name_en" class="form-control {{ $errors->has('name_en') ? 'form-control-danger' : '' }}" value="{{ old('name_en',$service_type->name_en) }}" placeholder="Name" >
                    @if($errors->has('name_en'))
                        <small class="form-control-feedback"> {{ $errors->first('name_en') }} </small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name_ar') ? 'has-danger' : '' }}">
                    <label class="control-label">الاسم</label>
                    <input type="text" id="name_ar" name="name_ar" class="form-control {{ $errors->has('name_ar') ? 'form-control-danger' : '' }}" value="{{ old('name_ar',$service_type->name_ar) }}" placeholder="الاسم" >
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
                    <textarea type="text" id="description_en" name="description_en" rows="5" class="form-control {{ $errors->has('description_en') ? 'form-control-danger' : '' }}" placeholder="Description" >{{ old('description_en',$service_type->description_en) }}</textarea>
                    @if($errors->has('description_en'))
                        <small class="form-control-feedback"> {{ $errors->first('description_en') }} </small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('description_ar') ? 'has-danger' : '' }}">
                    <label class="control-label">الوصف</label>
                    <textarea type="text" id="description_ar" name="description_ar" rows="5" class="form-control {{ $errors->has('description_ar') ? 'form-control-danger' : '' }}" placeholder="الوصف" >{{ old('description_ar',$service_type->description_ar) }}</textarea>
                    @if($errors->has('description_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('description_ar') }} </small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('price') ? 'has-danger' : '' }}">
                    <label class="control-label">{{trans('service_types/form.Price')}}</label>
                    <input type="text" id="Price" name="price" class="form-control {{ $errors->has('price') ? 'form-control-danger' : '' }}" value="{{ old('price',$service_type->price) }}" placeholder="{{trans('service_types/form.Price')}}" >
                    @if($errors->has('price'))
                        <small class="form-control-feedback"> {{ $errors->first('price') }} </small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('point_type_id') ? 'has-danger' : '' }}">
                    <label class="control-label">{{trans('service_types/form.point_type')}}</label>
                    <select type="text" name="point_type_id" class="form-control">
                        @foreach($point_types as $point_type)
                            <option value="{{ $point_type->id }}" @if($point_type->service_types_count) selected @endif>{{ $point_type->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('point_type_id'))
                        <small class="form-control-feedback"> {{ $errors->first('point_type_id') }} </small>
                    @endif
                </div>
            </div>
            <!--/span-->
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $service_type->id }}">
    <div class="form-actions">
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ $button }}</button>
    </div>
