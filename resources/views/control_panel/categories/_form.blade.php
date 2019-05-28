    <div class="form-body">
        <h3 class="card-title">{{ trans('categories/form.Category_Basic_Info') }}</h3>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="row p-t-20">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('name_en') ? 'has-danger' : '' }}">
                            <label class="control-label">Name</label>
                            <input type="text" id="Name_en" name="name_en" class="form-control {{ $errors->has('name_en') ? 'form-control-danger' : '' }}" value="{{ old('name_en',$category->name_en) }}" placeholder="Name" >
                            @if($errors->has('name_en'))
                                <small class="form-control-feedback"> {{ $errors->first('name_en') }} </small>
                            @endif
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('description_en') ? 'has-danger' : '' }}">
                            <label class="control-label">Description</label>
                            <textarea name="description_en" rows="5" class="form-control {{ $errors->has('description_en') ? 'form-control-danger' : '' }}" placeholder="description" >{{ old('description_en',$category->description_en) }}</textarea>
                            @if($errors->has('description_en'))
                                <small class="form-control-feedback"> {{ $errors->first('description_en') }} </small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row p-t-20">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('name_ar') ? 'has-danger' : '' }}">
                            <label class="control-label">الاسم</label>
                            <input type="text" id="Name" name="name_ar" class="form-control {{ $errors->has('name_ar') ? 'form-control-danger' : '' }}" value="{{ old('name_ar',$category->name_ar) }}" placeholder="الاسم" >
                            @if($errors->has('name_ar'))
                                <small class="form-control-feedback"> {{ $errors->first('name_ar') }} </small>
                            @endif
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('description_ar') ? 'has-danger' : '' }}">
                            <label class="control-label">الوصف</label>
                            <textarea name="description_ar" rows="5" class="form-control {{ $errors->has('description_ar') ? 'form-control-danger' : '' }}" placeholder="الوصف" >{{ old('description_ar',$category->description_ar) }}</textarea>
                            @if($errors->has('description_ar'))
                                <small class="form-control-feedback"> {{ $errors->first('description_ar') }} </small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($service_types)
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {{ $errors->has('service_type_id') ? 'has-danger' : '' }}">
                        <label class="control-label">{{ trans('categories/form.service_type') }}</label>
                        <select name="service_type_id" class="form-control {{ $errors->has('service_type_id') ? 'form-control-danger' : '' }}" >
                            @foreach($service_types as $service_type)
                                <option @if($service_type->categories_count) selected @endif value="{{ $service_type->id }}">{{ $service_type->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('service_type_id'))
                            <small class="form-control-feedback"> {{ $errors->first('service_type_id') }} </small>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        @if(isset($parent_choices))
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {{ $errors->has('parent_id') ? 'has-danger' : '' }}">
                        <label class="control-label">{{ trans('categories/form.parent') }}</label>
                        <select id="parent_id_select" name="parent_id" class="form-control {{ $errors->has('parent_id') ? 'form-control-danger' : '' }}" >
                            <option level="{{$parent_choices->level}}" @if($parent_choices->id == $category->parent_id) selected @endif value="{{ $parent_choices->id }}">{{ $parent_choices->name }}</option>
                            @foreach($parent_choices->sons as $son)
                                <option level="{{$son->level}}" @if($son->id == $category->parent_id) selected @endif value="{{ $son->id }}">{{ $son->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('parent_id'))
                            <small class="form-control-feedback"> {{ $errors->first('parent_id') }} </small>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        @if(isset($category->id))
            <input type="hidden" name="id" value="{{ $category->id }}">
        @endif
        <input type="hidden" name="root_id" value="{{ $root_id}}">
        <input type="hidden" name="parent_id" id="parent_id" value="{{ $parent_id }}">
        <input type="hidden" name="level" id="level" value="{{$category->level}}">

    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ $button }}</button>
    </div>

    <script>
        function changeLevel(level){
            // document.getElementById('level').value = parseInt(level)+1;
            console.log(level);
        }
        if(document.getElementById('categories')) {
            document.getElementById('categories').addEventListener('change', function (e) {
                // console.log(e.path[0].options[e.path[0].options['selectedIndex']].value);
                // console.log(typeof (e.path[0].options[e.path[0].options['selectedIndex']].attributes[0]['nodeValue']));
                document.getElementById('level').value = parseInt(e.path[0].options[e.path[0].options['selectedIndex']].attributes[0]['nodeValue']) + 1;
                document.getElementById('parent_id').value = parseInt(e.path[0].options[e.path[0].options['selectedIndex']].value);
            });
        }
    </script>