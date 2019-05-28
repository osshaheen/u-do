<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\newCityRequest;
use App\Http\Requests\updateCityRequest;
use App\State;
use Illuminate\Http\Request;

class citiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hasPermission('show cities');
        $cities = City::with('state.country')->get();
//        dd($states);
        $trashTrigger = 0;
        return view('control_panel.cities.cities',compact('cities','trashTrigger'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        hasPermission('create city');
        $city = new City();
        $states = State::all();
        return view('control_panel.cities.create',compact('states','city'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newCityRequest $request)
    {
        hasPermission('store city');
        City::create($request->only('name_en','name_ar','state_id'));
        return redirect()->back()->with(['msg' => 'new city data is stored', 'type' => 'success']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        hasPermission('edit city');
        $states = State::withCount(['cities'=>function($query) use($city){
            $query->where('id',$city->id);
        }])->get();
//        dd($states);
        return view('control_panel.cities.update',compact('city','states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(updateCityRequest $request, City $city)
    {
        hasPermission('update city');
        $city->update($request->only('name_en','name_ar','state_id'));
        return redirect()->back()->with(['msg' => 'a city data is updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        hasPermission('delete city');
        $city->delete();
        return redirect()->back()->with(['msg' => 'a city data is deleted', 'type' => 'success']);
    }
    public function trashedCities(){

        hasPermission('show trashed cities');
        $cities = City::onlyTrashed()->get();
        $trashTrigger = 1;
        return view('control_panel.cities.cities',compact('cities','trashTrigger'));
    }
    public function restoreCity($city_id){
        hasPermission('restore city');
        $city = City::onlyTrashed()->find($city_id);
//        dd($city);
        $city->restore();
        return redirect()->back()->with(['msg' => 'a city data is restored', 'type' => 'success']);
    }
    public function addCityAddress(City $city){
//        dd($city);
        $addressable_id = $city->id;
        $addressable_type = 'City';
        return view('control_panel.map',compact('addressable_id','addressable_type'));
    }
}
