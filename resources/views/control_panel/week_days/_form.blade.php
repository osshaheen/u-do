    <div class="form-body">
        <h3 class="card-title">{{trans('week_days/form.week_day_Basic_Info')}}</h3>
        <hr>
        <div class="row p-t-20">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('day_en') ? 'has-danger' : '' }}">
                    <label class="control-label">Day</label>
                    <input type="text" id="day_en" name="day_en" class="form-control {{ $errors->has('day_en') ? 'form-control-danger' : '' }}" value="{{ old('day_en',$weekDay->day_en) }}" placeholder="Day" >
                    @if(isset($weekDay->id))
                        <input type="hidden" name="id" value="{{$weekDay->id}}">
                    @endif
                    @if($errors->has('day_en'))
                        <small class="form-control-feedback"> {{ $errors->first('day_en') }} </small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row p-t-20">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('day_ar') ? 'has-danger' : '' }}">
                    <label class="control-label">اليوم</label>
                    <input type="text" id="day_ar" name="day_ar" class="form-control {{ $errors->has('day_ar') ? 'form-control-danger' : '' }}" value="{{ old('day_ar',$weekDay->day_ar) }}" placeholder="اليوم" >
                    @if(isset($weekDay->id))
                        <input type="hidden" name="id" value="{{$weekDay->id}}">
                    @endif
                    @if($errors->has('day_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('day_ar') }} </small>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ $button }}</button>
    </div>
