    <div class="form-body">
        <h3 class="card-title">{{ trans('Places/form.Place_Basic_Info') }}</h3>
        <hr>
        {{--@if(count($place->toArray()))--}}
            {{--<div class="row p-t-20 justify-content-center">--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="form-group">--}}
                        {{--<img src="{{asset("storage/".$place->image_path)}}" onclick="uploadFile()" id="mediable_image" style="max-height: 250px;max-width: 250px">--}}
                        {{--<input type="file" name="image" accept="image/*" class="form-control" onchange="uploadPicture('{{$place->id}}','App\\Place')" style="display: none;" id="mediable">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endif--}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name_en') ? 'has-danger' : '' }}">
                    <label class="control-label">Name</label>
                    <input type="text" id="name_en" name="name_en" class="form-control {{ $errors->has('name_en') ? 'form-control-danger' : '' }}" value="{{ old('name_en',$place->name_en) }}" placeholder="Name" >
                    @if($errors->has('name_en'))
                        <small class="form-control-feedback"> {{ $errors->first('name_en') }} </small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name_ar') ? 'has-danger' : '' }}">
                    <label class="control-label">الاسم</label>
                    <input type="text" id="name_ar" name="name_ar" class="form-control {{ $errors->has('name_ar') ? 'form-control-danger' : '' }}" value="{{ old('name_ar',$place->name_ar) }}" placeholder="الاسم" >
                    @if($errors->has('name_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('name_ar') }} </small>
                    @endif
                </div>
            </div>
            <!--/span-->
            <!--/span-->
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('bio_en') ? 'has-danger' : '' }}">
                    <label class="control-label">bio_en</label>
                    <textarea type="text" id="bio_en" name="bio_en" rows="5" class="form-control {{ $errors->has('bio_en') ? 'form-control-danger' : '' }}" placeholder="Bio" >{{ old('bio_en',$place->bio_en) }}</textarea>
                    @if($errors->has('bio_en'))
                        <small class="form-control-feedback"> {{ $errors->first('bio_en') }} </small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('bio_ar') ? 'has-danger' : '' }}">
                    <label class="control-label">نبذة</label>
                    <textarea type="text" id="bio_ar" name="bio_ar" rows="5" class="form-control {{ $errors->has('bio_ar') ? 'form-control-danger' : '' }}" placeholder="نبذة" >{{ old('bio_ar',$place->bio_ar) }}</textarea>
                    @if($errors->has('bio_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('bio_ar') }} </small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('service_type_id') ? 'has-danger' : '' }}">
                    <label class="control-label">{{ trans('Places/form.service_type') }}</label>
                    <select type="text" name="service_type_id" class="form-control">
                        @foreach($service_types as $service_type)
                            <option value="{{ $service_type->id }}" @if($service_type->places_count) selected @endif>{{ $service_type->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('service_type_id'))
                        <small class="form-control-feedback"> {{ $errors->first('service_type_id') }} </small>
                    @endif
                </div>
            </div>
            <input type="hidden" value="{{ $place->id }}" name="id">
            <!--/span-->
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ $button }}</button>
    </div>
