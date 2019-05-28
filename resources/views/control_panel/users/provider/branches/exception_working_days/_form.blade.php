    <div class="form-body">
        <h3 class="card-title">{{ trans('users/providers/branches/exception_working_days/form.Exception_working_day_Basic_Info') }}</h3>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('day') ? 'has-danger' : '' }}">
                    <label>day</label>
                    <input type="datetime-local" name="day" class="form-control {{ $errors->has('day') ? 'form-control-danger' : '' }}" value="{{ old('day',$exceptionWorkingDay->day ? (new DateTime($exceptionWorkingDay->day))->format("Y-m-d\TH:i:s"):'') }}" >
                    <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                    @if(isset($exceptionWorkingDay->id))
                        <input type="hidden" name="id" value="{{ $exceptionWorkingDay->id }}">
                    @endif
                    @if($errors->has('day'))
                        <small class="form-control-feedback"> {{ $errors->first('day') }} </small>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ $button }}</button>
    </div>
