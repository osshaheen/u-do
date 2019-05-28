
    <div class="form-body">
        <h3 class="card-title">{{ trans('Places/branches/form.Place_Branch_Basic_Info') }}</h3>
        <hr>
        {{--@if(count($branch->toArray()))--}}
            {{--<div class="row p-t-20 justify-content-center">--}}
                {{--<div class="col-md-4">--}}
                    {{--<div class="form-group">--}}
                        {{--<img src="{{asset("storage/".$branch->image_path)}}" onclick="uploadFile()" id="mediable_image" style="max-height: 250px;max-width: 250px">--}}
                        {{--<input type="file" name="image" accept="image/*" class="form-control" onchange="uploadPicture('{{$branch->id}}','App\\Place')" style="display: none;" id="mediable">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endif--}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name_en') ? 'has-danger' : '' }}">
                    <label class="control-label">Name</label>
                    <input type="text" id="name_en" name="name_en" class="form-control {{ $errors->has('name_en') ? 'form-control-danger' : '' }}" value="{{ old('name_en',$branch->name_en) }}" placeholder="Name" >
                    @if($errors->has('name_en'))
                        <small class="form-control-feedback"> {{ $errors->first('name_en') }} </small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name_ar') ? 'has-danger' : '' }}">
                    <label class="control-label">الاسم</label>
                    <input type="text" id="name_ar" name="name_ar" class="form-control {{ $errors->has('name_ar') ? 'form-control-danger' : '' }}" value="{{ old('name_ar',$branch->name_ar) }}" placeholder="الاسم" >
                    @if($errors->has('name_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('name_ar') }} </small>
                    @endif
                </div>
            </div>
            <!--/span-->
        </div>
        @if(isset($branch->id))
            <input type="hidden" value="{{ $branch->id }}" name="id">
        @endif
        <ul id="fieldList">
            @if($details_exists)
                @foreach($details as $detail)
                    <li>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('property_en') ? 'has-danger' : '' }}">
                                    <label class="control-label">Property</label>
                                    <input type="text" id="property_en" name="property_en[]" class="form-control {{ $errors->has('property_en') ? 'form-control-danger' : '' }}" value="{{ old('property_en',$detail->property_en) }}" placeholder="Property" >
                                    <input type="hidden" value="{{ $detail->id }}" name="details_id[]">
                                    @if($errors->has('property_en'))
                                        <small class="form-control-feedback"> {{ $errors->first('property_en') }} </small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('value_en') ? 'has-danger' : '' }}">
                                    <label class="control-label">Value</label>
                                    <input type="text" name="value_en[]" class="form-control {{ $errors->has('value_en') ? 'form-control-danger' : '' }}" value="{{ old('value_en',$detail->value_en) }}" placeholder="value" >
                                    @if($errors->has('value_en'))
                                        <small class="form-control-feedback"> {{ $errors->first('value_en') }} </small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('property_ar') ? 'has-danger' : '' }}">
                                    <label class="control-label">الخاصية</label>
                                    <input type="text" id="property_ar" name="property_ar[]" class="form-control {{ $errors->has('property_ar') ? 'form-control-danger' : '' }}" value="{{ old('property_ar',$detail->property_ar) }}" placeholder="الخاصية" >
                                    @if($errors->has('property_ar'))
                                        <small class="form-control-feedback"> {{ $errors->first('property_ar') }} </small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('value_ar') ? 'has-danger' : '' }}">
                                    <label class="control-label">القيمة</label>
                                    <input type="text" name="value_ar[]" class="form-control {{ $errors->has('value_ar') ? 'form-control-danger' : '' }}" value="{{ old('value_ar',$detail->value_ar) }}" placeholder="القيمة" >
                                    @if($errors->has('value_ar'))
                                        <small class="form-control-feedback"> {{ $errors->first('value_ar') }} </small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="close_button" onclick="deleteDetail('{{ $detail->id }}',this)">X</div>
                            </div>
                            <!--/span-->
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
        <input type="hidden" value="{{ $place->id }}" name="place_id">
    </div>
    <div class="form-actions">
        <button id="addMore" class="btn btn-success"><i class="fa fa-plus"></i>{{ trans('Places/branches/form.Add_more_fields') }}</button>
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ $button }}</button>
    </div>
