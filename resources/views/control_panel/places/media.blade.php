@extends('control_panel.control_panel_master')

@section('style')
    <link href="{{asset('/control_panel/assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('/control_panel/dist/css/pages/user-card.css')}}" rel="stylesheet">

@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('Places/place_media.Place_Media') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                @if(!$trashTrigger)
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('places.media',$place->id) }}">{{ trans('Places/place_media.Show_Media_of') }} {{ $place->name }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('places.index')}}">{{ trans('Places/place_media.Places_title') }}</a></li>
                </ol>
                    <a href="{{ route('places.media.create',$place->id) }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> {{ trans('Places/place_media.Create_Place') }}</a>
                    <a href="{{ route('places.media.trashed',$place->id) }}" class="btn btn-danger d-none d-lg-block m-l-15"><i class="fa fa-trash"></i>{{ trans('Places/place_media.Trashed_Places') }}</a>
                @else
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('places.media.trashed',$place->id) }}">{{ trans('Places/place_media.Trashed_Places') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('places.media',$place->id) }}">{{ trans('Places/place_media.Place_Media') }}</a></li>
                    </ol>
                @endif
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row m-t-40">
        <div class="col-md-12">
            <h4 class="card-title">{{ trans('Places/place_media.Gallery') }} {{ $place->name }}</h4>
        </div>
    </div>
    <div class="card-columns el-element-overlay">
    @if($trashTrigger)
        @foreach($med_ia as $media)
                <div class="card">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1">
                            <?=$media->media_path?>
                        </div>
                        <div class="el-card-content">
                            <h3 class="box-title">
                                <a href="{{ route('places.media.restore',$media->id) }}" class="btn btn-success">{{ trans('Places/place_media.restore') }}</a>
                            </h3>
                            <small>{{ $media->original_name }}</small>
                            <br/>
                        </div>
                    </div>
                </div>
        @endforeach
    @else
        @foreach($place->media as $media)
<!--            --><?php //dd($media,$media->media_path); ?>
            <div class="card">
                <div class="el-card-item">
                    <div class="el-card-avatar el-overlay-1">
                        <?=$media->media_path?>
                    </div>
                    <div class="el-card-content">
                        <h3 class="box-title">
                            <form action="{{ route('placesMedia.destroy',$media->id) }}" method="post" class="d-inline-block">
                                @method('delete')
                                @csrf
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                            @if(!$media->is_main)
                                <a href="{{ route('places.media.main',$media->id) }}" class="btn btn-success">{{ trans('Places/place_media.main') }}</a>
                            @endif
                        </h3>
                        {{--<small>{{ $media->original_name }}</small>--}}
                        <br/> </div>
                </div>
            </div>
        @endforeach
    @endif
    </div>
@endsection

@section('script')

    <!-- Magnific popup JavaScript -->
    <script src="{{asset('/control_panel/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('/control_panel/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
    <script src="{{asset('/control_panel/assets/node_modules/switchery/dist/switchery.min.js')}}"></script>
    <script>
        if(document.getElementById('places')){
            document.getElementById('places').classList.add('selected');
        }
    </script>
@endsection