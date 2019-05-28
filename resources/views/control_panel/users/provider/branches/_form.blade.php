    <div class="form-body">
        <h3 class="card-title">{{ trans('users/providers/branches/form.Branches_Basic_Info') }}</h3>
        <hr>
        @if(count($branch->toArray())>1)
        <div class="row p-t-20 justify-content-center">
            <div class="col-md-4">
                <div class="form-group">
                    <img src="{{asset("storage/".$branch->image_path)}}" onclick="uploadFile()" id="mediable_image" style="max-height: 250px;max-width: 250px">
                    <input type="file" name="image" accept="image/*" class="form-control" onchange="uploadPicture('{{$branch->id}}','App\\Branch')" style="display: none;" id="mediable">
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name_en') ? 'has-danger' : '' }}">
                    <label>name</label>
                    <input type="text" name="name_en" class="form-control {{ $errors->has('name_en') ? 'form-control-danger' : '' }}" value="{{ old('name_en',$branch->name_en) }}" >
                    <input type="hidden" name="provider_id" value="{{ $branch->provider_id }}" >
                    @if(isset($branch->id))
                        <input type="hidden" name="id" value="{{ $branch->id }}" >
                    @endif
                    @if($errors->has('name_en'))
                        <small class="form-control-feedback"> {{ $errors->first('name_en') }} </small>
                    @endif
                </div>
            </div>
<!--            --><?php //dd($errors); ?>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name_ar') ? 'has-danger' : '' }}">
                    <label>الاسم</label>
                    <input type="text" name="name_ar" class="form-control {{ $errors->has('name_ar') ? 'form-control-danger' : '' }}" value="{{ old('name_ar',$branch->name_ar) }}" >
                    @if($errors->has('name_ar'))
                        <small class="form-control-feedback"> {{ $errors->first('name_ar') }} </small>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ $button }}</button>
    </div>
