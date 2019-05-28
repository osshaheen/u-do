<?php

namespace App\Http\Controllers;

use App\Http\Requests\newPlaceMediaRequest;
use App\Media;
use App\Place;
use Illuminate\Http\Request;

class PlaceMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Place $place)
    {
        hasPermission('create place media');
        return view('control_panel.places.createMedia',compact('place'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newPlaceMediaRequest $request)
    {
//        dd($request);
        hasPermission('store place media');
        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                $uploaded_file = $file->store('public','public');
//                dd($file->getClientOriginalName());
                Media::create([
                    'mediable_type' => $request->mediable_type,
                    'mediable_id'   => $request->mediable_id,
                    'type'          => $file->getMimeType(),
                    'original_name' => $file->getClientOriginalName(),
                    'path'          => $uploaded_file
                ]);
            }
        }
        return redirect(route('places.media',$request->mediable_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy($place_media_id)
    {
        hasPermission('delete place media');
        Media::destroy($place_media_id);
        return redirect()->back()->with(['msg' => 'media data is deleted', 'type' => 'success']);
    }
    public function trashedPlaceMedia(Place $place){
        hasPermission('show trashed place media');
        $med_ia = Media::onlyTrashed()->where('mediable_type','App\Place')->where('mediable_id',$place->id)->get();
//        dd($media,$place);
        $trashTrigger = 1;
        return view('control_panel.places.media',compact('place','med_ia','trashTrigger'));
    }
    public function restorePlaceMedia($place_media_id){
        hasPermission('restore place media');
        Media::onlyTrashed()->find($place_media_id)->restore();
        return redirect()->back()->with(['msg' => 'media is restored', 'type' => 'success']);
    }
    public function setMain($media_id){
        hasPermission('set place media as main');
        $media = Media::find($media_id);
        $placeMainMedia = Media::where('mediable_id',$media->mediable_id)->where('mediable_type','App\Place')->where('is_main',1)->first();
//        dd($placeMainMedia);
        if($placeMainMedia){
            $placeMainMedia->update(['is_main'=>0]);
        }
        $media->update(['is_main'=>1]);
        return redirect()->back()->with(['msg' => 'media is updated to be main of its place', 'type' => 'success']);
    }
}
