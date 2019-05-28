    <div class="form-body">
        <h3 class="card-title">{{ trans('cities/form.City_Basic_Info') }}</h3>
        <hr>
        <div class="row p-t-20">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name_en') ? 'has-danger' : '' }}">
                    <label class="control-label">Name</label>
                    <input type="text" id="name_en" name="name_en" class="form-control {{ $errors->has('name_en') ? 'form-control-danger' : '' }}" value="{{ old('name_en',$city->name_en) }}" placeholder="Name" >
                    @if($errors->has('name_en'))
                        <small class="form-control-feedback"> {{ $errors->first('name_en') }} </small>
                    @endif
                </div>
            </div>
            @if(isset($city->id))
                <input type="hidden" value="{{ $city->id }}" name="id">
            @endif
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name_ar') ? 'has-danger' : '' }}">
                    <label class="control-label">الاسم</label>
                    <input type="text" id="name_ar" name="name_ar" class="form-control {{ $errors->has('name_ar') ? 'form-control-danger' : '' }}" value="{{ old('name_ar',$city->name_ar) }}" placeholder="الاسم" >
                    @if($errors->has('name_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('name_ar') }} </small>
                    @endif
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row p-t-20">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('state_id') ? 'has-danger' : '' }}">
                    <label class="control-label">state</label>
                    <select type="text" name="state_id" class="form-control">
                        @foreach($states as $state)
                            <option value="{{ $state->id }}" @if($state->cities_count) selected @endif>{{ $state->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('state_id'))
                        <small class="form-control-feedback"> {{ $errors->first('state_id') }} </small>
                    @endif
                </div>
            </div>
            <!--/span-->
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ $button }}</button>
    </div>
