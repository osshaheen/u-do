@extends('control_panel.control_panel_master')

@section('style')
    <link rel="stylesheet" href="{{asset('/control_panel/assets/node_modules/dropify/dist/css/dropify.min.css')}}">
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('Places/create_media.Places_title') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('places.media.create',$place->id) }}">{{ trans('Places/create_media.Create_Place_media') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('places.media',$place->id) }}">{{ trans('Places/create_media.Places_Media') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('places.index')}}">{{ trans('Places/create_media.Places_title') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="d-inline-block m-b-0 text-white">{{ trans('Places/create_media.Create_Place_media') }}</h4>
                    <input type="submit" value="send" form="upload_file" class="float-left btn btn-primary">
                </div>
                <div class="card-body">
                    <form method="post" id="upload_file" action="{{ route('placesMedia.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row {{ $errors->any() ? 'has-danger' : '' }}">
                            <div class=" col-lg-6 col-md-6" style="margin:auto">
                                @if($errors->any())
                                    <small class="form-control-feedback"> {{ $errors->first() }} </small>
                                @endif
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $place->name }} {{ trans('Places/create_media.media_upload') }}</h4>
                                        <input type="file" name="files[]" accept="video/*|image/*" id="input-file-now-custom-2" class="dropify" data-height="500" multiple />
                                    </div>
                                </div>
                                <input type="hidden" value="App\Place" name="mediable_type">
                                <input type="hidden" value="{{ $place->id }}" name="mediable_id">
                            </div>
                        </div>
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
    </script>
    <script src="{{asset('/control_panel/assets/node_modules/dropify/dist/js/dropify.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>
@endsection