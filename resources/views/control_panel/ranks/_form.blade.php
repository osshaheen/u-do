    <div class="form-body">
        <h3 class="card-title">{{ trans('ranks/form.Rank_Basic_Info') }}</h3>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('title_en') ? 'has-danger' : '' }}">
                    <label class="control-label">Title</label>
                    <input type="text" id="title_en" name="title_en" class="form-control {{ $errors->has('title_en') ? 'form-control-danger' : '' }}" value="{{ old('title_en',$rank->title_en) }}" placeholder="Title" >
                    @if($errors->has('title_en'))
                        <small class="form-control-feedback"> {{ $errors->first('title_en') }} </small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('title_ar') ? 'has-danger' : '' }}">
                    <label class="control-label">العنوان</label>
                    <input type="text" id="title_ar" name="title_ar" class="form-control {{ $errors->has('title_ar') ? 'form-control-danger' : '' }}" value="{{ old('title_ar',$rank->title_ar) }}" placeholder="العنوان" >
                    @if($errors->has('title_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('title_ar') }} </small>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{ $rank->id }}" name="id">
    <div class="form-actions">
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ $button }}</button>
    </div>
