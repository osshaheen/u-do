<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests\newStateRequest;
use App\Http\Requests\updateSteateRequest;
use App\State;
use Illuminate\Http\Request;

class statesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hasPermission('show states');
        $states = State::with('country')->get();
//        dd($states);
        $trashTrigger = 0;
        return view('control_panel.states.states',compact('states','trashTrigger'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        hasPermission('create state');
        $state = new State();
        $countries = Country::all();
        return view('control_panel.states.create',compact('countries','state'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newStateRequest $request)
    {
        hasPermission('store state');
        State::create($request->only('name_en','name_ar','country_id'));
        return redirect()->back()->with(['msg' => 'new state data is stored', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
//        dd($state);
        hasPermission('edit state');
        $countries = Country::withCount(['states'=>function($query) use($state){
            $query->where('id',$state->id);
        }])->get();
//        dd($countries);
        return view('control_panel.states.update',compact('state','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(updateSteateRequest $request, State $state)
    {
        hasPermission('update state');
        $state->update($request->only('name_en','name_ar','country_id'));
        return redirect()->back()->with(['msg' => 'a state data is updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        hasPermission('delete state');
        $state->delete();
        return redirect()->back()->with(['msg' => 'a state data is deleted', 'type' => 'success']);
    }
    public function trashedStates(){

        hasPermission('show trashed states');
        $states = State::onlyTrashed()->get();
        $trashTrigger = 1;
        return view('control_panel.states.states',compact('states','trashTrigger'));
    }
    public function restoreState(State $state){
        hasPermission('restore state');
        $state->restore();
        return redirect()->back()->with(['msg' => 'a state data is restored', 'type' => 'success']);
    }
}
