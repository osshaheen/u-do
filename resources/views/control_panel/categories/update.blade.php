@extends('control_panel.control_panel_master')

@section('style')
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ trans('categories/update.categories_title') }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('categories.edit',$category->id) }}">{{ trans('categories/update.Update_Category') }}</a></li>
                    @foreach($parents as $key => $value)
                        <li class="breadcrumb-item active"><a href="{{ route('categories.index',$key) }}">{{ $value }}</a></li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
    @include('control_panel.messages._response')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">{{ trans('categories/update.Update_Category') }}</h4>
                </div>
                <?php // if($errors->any()) dd($errors); ?>
                <div class="card-body">
                    <form method="post" action="{{ route('categories.update',$category->id) }}">
                        @method('put')
                        @csrf
                        @include('control_panel.categories._form',['button'=>'Update category'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        if(document.getElementById('categories')){
            document.getElementById('categories').classList.add('selected');
        }
        // function changeLevel(level){
        //     // document.getElementById('level').value = parseInt(level)+1;
        //     console.log(level);
        // }
    </script>
@endsection