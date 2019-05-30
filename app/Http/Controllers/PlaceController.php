<?php

namespace App\Http\Controllers;

use App\Http\Requests\newPlaceRequest;
use App\Http\Requests\updatePlaceRequest;
use App\Imports\PlaceBranches;
use App\Place;
use App\ServiceType;
use Importer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hasPermission('show places');
        $places = Place::with(['service_type'])->get();
        $trashTrigger = 0;
//        dd($places);
        return view('control_panel.places.places',compact('places','trashTrigger'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        hasPermission('create place');
        $place = new Place();
        $service_types = ServiceType::all();
        return view('control_panel.places.create',compact('place','service_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newPlaceRequest $request)
    {
        hasPermission('store place');
        Place::create($request->only('name_en','bio_en','name_ar','bio_ar','service_type_id'));
        return redirect()->back()->with(['msg' => 'new place data is stored', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        hasPermission('show place branches');
        $place->load('branches','service_type');
        $trashTrigger = 0;
        return view('control_panel.places.branches.branches',compact('place','trashTrigger'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        hasPermission('edit place');
        $service_types = ServiceType::withCount(['places'=>function($query) use($place){
            $query->where('id',$place->id);
        }])->get();
        return view('control_panel.places.update',compact('place','service_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(updatePlaceRequest $request, Place $place)
    {
        hasPermission('update place');
        $place->update($request->only('name_en','bio_en','name_ar','bio_ar','service_type_id'));
        return redirect()->back()->with(['msg' => 'a place data is updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        hasPermission('delete place');
        $place->delete();
        return redirect()->back()->with(['msg' => 'a place data is deleted', 'type' => 'success']);
    }
    public function trashedPlaces(){

        hasPermission('show trashed places');
        $places = Place::onlyTrashed()->get();
        $trashTrigger = 1;
        return view('control_panel.places.places',compact('places','trashTrigger'));
    }
    public function restorePlace(Place $place){
        hasPermission('restore place');
        $place->restore();
        return redirect()->back()->with(['msg' => 'a place data is restored', 'type' => 'success']);
    }
    public function placeMedia(Place $place){

        hasPermission('show place media');
        $place->load('media');
//        dd($place);
        $trashTrigger = 0;
        return view('control_panel.places.media',compact('place','trashTrigger'));
    }
    public function addPlaceWithExcel(Request $request){
//        dd($request);
        $file = $request->file('excel_file')->store('public','public');
        $excel = Importer::make('Excel');
        $excel->load(public_path().'/storage/'.$file);
        $collection = $excel->getCollection();
        $place = Place::create([
            'name_en'=>$collection[1][2],
            'bio_en'=>$collection[1][3],
            'name_ar'=>$collection[1][2],
            'bio_ar'=>$collection[1][3],
            'service_type_id'=>$collection[1][1],
        ]);
        Excel::import(new PlaceBranches($place->id), public_path().'/storage/'.$file);
        dd($place);
    }
}
