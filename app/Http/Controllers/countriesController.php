<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests\newCountryRequest;
use App\Http\Requests\updateCountryRequest;
use Illuminate\Http\Request;

class countriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hasPermission('show countries');
        $countries = Country::all();
        $trashTrigger = 0;
        return view('control_panel.countries.countries',compact('countries','trashTrigger'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        hasPermission('create country');
        $country = new Country();
        return view('control_panel.countries.create',compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newCountryRequest $request)
    {
//        dd($request);
        hasPermission('store country');
        Country::create($request->only('name_en','name_ar'));
        return redirect()->back()->with(['msg' => 'new country data is stored', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        hasPermission('edit country');
        return view('control_panel.countries.update',compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(updateCountryRequest $request, Country $country)
    {
        hasPermission('update country');
        $country->update($request->only('name_en','name_ar'));
        return redirect()->back()->with(['msg' => 'a country data is updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
        hasPermission('delete country');
        $country->delete();
        return redirect()->back()->with(['msg' => 'a country data is deleted', 'type' => 'success']);
    }
    public function trashedCountries(){

        hasPermission('show trashed countries');
        $countries = Country::onlyTrashed()->get();
        $trashTrigger = 1;
        return view('control_panel.countries.countries',compact('countries','trashTrigger'));
    }
    public function restoreCountry(Country $country){
        hasPermission('restore country');
        $country->restore();
        return redirect()->back()->with(['msg' => 'a country data is restored', 'type' => 'success']);
    }
}
