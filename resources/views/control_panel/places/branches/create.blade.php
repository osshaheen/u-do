@extends('control_panel.control_panel_master')

@section('style')

    <style>
        ul {
            padding: 0;
            margin: 0;
        }

        ul li {
            list-style: none;
        }
        .close_button{
            margin-top: 36px;
            color:red;
        }
        .close_button:hover{
            cursor:pointer ;
        }
    </style>
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('Places/branches/create.Place_Branches_title') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('places.branch.create',$place->id) }}">{{ trans('Places/branches/create.Create_Place_Branch') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('places.show',$place->id) }}">{{ trans('Places/branches/create.Place_Branches_title') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('places.index') }}">{{ trans('Places/branches/create.Places') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">{{ trans('Places/branches/create.Create_Place_Branch') }}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('placesBranch.store') }}">
                        @csrf
                        @include('control_panel.places.branches._form',['button'=>trans('Places/branches/create.Create_Place_Branch')])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        if(document.getElementById('places')){
            document.getElementById('places').classList.add('selected');
        }
        $(function() {
            $("#addMore").click(function(e) {
                e.preventDefault();
                $("#fieldList").append("<li>&nbsp;</li>");
                $("#fieldList").append("<li><div class=\"row\">\n" +
                    "                    <div class=\"col-md-3\">\n" +
                    "                        <div class=\"form-group {{ $errors->has('property_en') ? 'has-danger' : '' }}\">\n" +
                    "                            <label class=\"control-label\">Property</label>\n" +
                    "                            <input type=\"text\" id=\"property_en\" name=\"property_en[]\" class=\"form-control {{ $errors->has('property_en') ? 'form-control-danger' : '' }}\" value=\"{{ old('property_en') }}\" placeholder=\"Property\" >\n" +
                    "                            @if($errors->has('property_en'))\n" +
                    "                                <small class=\"form-control-feedback\"> {{ $errors->first('property_en') }} </small>\n" +
                    "                            @endif\n" +
                    "                        </div>\n" +
                    "                    </div>\n" +
                    "                    <div class=\"col-md-2\">\n" +
                    "                        <div class=\"form-group {{ $errors->has('value_en') ? 'has-danger' : '' }}\">\n" +
                    "                            <label class=\"control-label\">Value</label>\n" +
                    "                            <input type=\"text\" name=\"value_en[]\" class=\"form-control {{ $errors->has('value_en') ? 'form-control-danger' : '' }}\" value=\"{{ old('value_en') }}\" placeholder=\"value\" >\n" +
                    "                            @if($errors->has('value_en'))\n" +
                    "                                <small class=\"form-control-feedback\"> {{ $errors->first('value_en') }} </small>\n" +
                    "                            @endif\n" +
                    "                        </div>\n" +
                    "                    </div>\n" +
                    "                    <div class=\"col-md-3\">\n" +
                    "                        <div class=\"form-group {{ $errors->has('property_ar') ? 'has-danger' : '' }}\">\n" +
                    "                            <label class=\"control-label\">الخاصية</label>\n" +
                    "                            <input type=\"text\" id=\"property_ar\" name=\"property_ar[]\" class=\"form-control {{ $errors->has('property_ar') ? 'form-control-danger' : '' }}\" value=\"{{ old('property_ar') }}\" placeholder=\"الخاصية\" >\n" +
                    "                            @if($errors->has('property_ar'))\n" +
                    "                                <small class=\"form-control-feedback\"> {{ $errors->first('property_ar') }} </small>\n" +
                    "                            @endif\n" +
                    "                        </div>\n" +
                    "                    </div>\n" +
                    "                    <div class=\"col-md-2\">\n" +
                    "                        <div class=\"form-group {{ $errors->has('value_ar') ? 'has-danger' : '' }}\">\n" +
                    "                            <label class=\"control-label\">القيمة</label>\n" +
                    "                            <input type=\"text\" name=\"value_ar[]\" class=\"form-control {{ $errors->has('value_ar') ? 'form-control-danger' : '' }}\" value=\"{{ old('value_ar') }}\" placeholder=\"القيمة\" >\n" +
                    "                            @if($errors->has('value_ar'))\n" +
                    "                                <small class=\"form-control-feedback\"> {{ $errors->first('value_ar') }} </small>\n" +
                    "                            @endif\n" +
                    "                        </div>\n" +
                    "                    </div>\n" +
                    "                            <div class=\"col-md-2\">\n" +
                    "                                <div class=\"close_button\"  onclick=\"deleteDetailLocal(this)\">X</div>\n" +
                    "                            </div>"+
                    "                    <!--/span-->\n" +
                    "                </div></li>");
            });
        });
        function deleteDetailLocal(obj) {
            var elem = obj.parentElement.parentElement.parentElement;
            elem.parentNode.removeChild(elem);
        }
    </script>
@endsection