<?php

namespace App\Http\Controllers;

use App\Http\Requests\newPointTypeRequest;
use App\Http\Requests\updatePointTypeRequest;
use App\PointType;
use Illuminate\Http\Request;

class PointTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hasPermission('show point types');
        $point_types = PointType::all();
        $trashTrigger = 0;
        return view('control_panel.point_types.point_types',compact('point_types','trashTrigger'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        hasPermission('create point type');
        $point_type = new PointType();
        return view('control_panel.point_types.create',compact('point_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newPointTypeRequest $request)
    {
//        dd($request);
        hasPermission('store point type');
        PointType::create($request->only('name_en','description_en','name_ar','description_ar','points'));
        return redirect()->back()->with(['msg' => 'new point type data is stored', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PointType  $pointType
     * @return \Illuminate\Http\Response
     */
    public function show(PointType $pointType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PointType  $pointType
     * @return \Illuminate\Http\Response
     */
    public function edit(PointType $point_type)
    {
        hasPermission('edit point type');
        return view('control_panel.point_types.update',compact('point_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PointType  $pointType
     * @return \Illuminate\Http\Response
     */
    public function update(updatePointTypeRequest $request, PointType $pointType)
    {
        hasPermission('update point type');
        $pointType->update($request->only('name_en','description_en','name_ar','description_ar','points'));
        return redirect()->back()->with(['msg' => 'a point type data is updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PointType  $pointType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PointType $pointType)
    {
        hasPermission('delete point type');
        $pointType->delete();
        return redirect()->back()->with(['msg' => 'a point type data is deleted', 'type' => 'success']);
    }
    public function trashedPointType(){

        hasPermission('show trashed point types');
        $point_types = PointType::onlyTrashed()->get();
        $trashTrigger = 1;
        return view('control_panel.point_types.point_types',compact('point_types','trashTrigger'));
    }
    public function restorePointType(PointType $pointType){
        hasPermission('restore point type');
        $pointType->restore();
        return redirect()->back()->with(['msg' => 'a point type data is restored', 'type' => 'success']);
    }
}
