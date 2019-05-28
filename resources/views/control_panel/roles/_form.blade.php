    <div class="form-body">
        <h3 class="card-title">{{trans('roles/form.Role_Basic_Info')}}</h3>
        <hr>
        <div class="row p-t-20">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('name') ? 'has-danger' : '' }}">
                    <label class="control-label">Name</label>
                    <input type="text" id="Name" name="name" class="form-control {{ $errors->has('name') ? 'form-control-danger' : '' }}" value="{{ old('name',$role->name) }}" placeholder="Name" >
                    @if(isset($role->id))
                        <input type="hidden" value="{{ $role->id }}" name="id">
                    @endif
                    @if($errors->has('name'))
                        <small class="form-control-feedback"> {{ $errors->first('name') }} </small>
                    @endif
                </div>
            </div>
            <!--/span-->
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ $button }}</button>
    </div>
