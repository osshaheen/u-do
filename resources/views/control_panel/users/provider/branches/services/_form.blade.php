    <div class="form-body">
        <h3 class="card-title">{{ trans('users/providers/branches/services/form.Service_Basic_Info') }}</h3>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name_en') ? 'has-danger' : '' }}">
                    <label>name</label>
                    <input type="text" name="name_en" class="form-control {{ $errors->has('name_en') ? 'form-control-danger' : '' }}" value="{{ old('name_en',$service->name_en) }}" >
                    @if($errors->has('name_en'))
                        <small class="form-control-feedback"> {{ $errors->first('name_en') }} </small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name_ar') ? 'has-danger' : '' }}">
                    <label>الاسم</label>
                    <input type="text" name="name_ar" class="form-control {{ $errors->has('name_ar') ? 'form-control-danger' : '' }}" value="{{ old('name_ar',$service->name_ar) }}" >
                    @if($errors->has('name_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('name_ar') }} </small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('description_en') ? 'has-danger' : '' }}">
                    <label>Description</label>
                    <textarea  rows="5" name="description_en" class="form-control {{ $errors->has('description_en') ? 'form-control-danger' : '' }}">{{ old('description_en',$service->description_en) }}</textarea>
                    <input type="hidden" name="branch_id" value="{{ $branch->id }}" >
                    @if($errors->has('description_en'))
                        <small class="form-control-feedback"> {{ $errors->first('description_en') }} </small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('description_ar') ? 'has-danger' : '' }}">
                    <label>الوصف</label>
                    <textarea rows="5" name="description_ar" class="form-control {{ $errors->has('description_ar') ? 'form-control-danger' : '' }}">{{ old('description_ar',$service->description_ar) }}</textarea>
                    <input type="hidden" name="branch_id" value="{{ $branch->id }}" >
                    @if($errors->has('description_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('description_ar') }} </small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('category_id') ? 'has-danger' : '' }}">
                    <label>{{ trans('users/providers/branches/services/form.Categories') }}</label>
                    <select name="category_id" class="form-control {{ $errors->has('category_id') ? 'form-control-danger' : '' }}">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id == $service->category_id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category_id'))
                        <small class="form-control-feedback"> {{ $errors->first('category_id') }} </small>
                    @endif
                </div>
            </div>
            @if(isset($service->id))
                <input type="hidden" name="id" value="{{ $service->id }}">
            @endif
            {{--<div class="col-md-6">--}}
                {{--<div class="form-group {{ $errors->has('expired_at') ? 'has-danger' : '' }}">--}}
                    {{--<label>expired date</label>--}}
                    {{--<input type="date" name="expired_at" class="form-control {{ $errors->has('expired_at') ? 'form-control-danger' : '' }}" value="{{ old('expired_at',$service->expired_at) }}" >--}}
                    {{--@if($errors->has('expired_at'))--}}
                        {{--<small class="form-control-feedback"> {{ $errors->first('expired_at') }} </small>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ $button }}</button>
    </div>
