<?php

namespace App\Http\Controllers;

use App\Http\Requests\newServiceTypeRequest;
use App\Http\Requests\updateServiceTypeRequest;
use App\PointType;
use App\ServiceType;
use App\Tag;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hasPermission('show service types');
        $service_types = ServiceType::with('point_type')->get();
//        dd($service_types);
        $trashTrigger = 0;
        return view('control_panel.service_types.service_types',compact('service_types','trashTrigger'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        hasPermission('create service type');
        $service_type = new ServiceType();
        $point_types = PointType::all();
//        dd($point_types);
        return view('control_panel.service_types.create',compact('service_type','point_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newServiceTypeRequest $request)
    {
        hasPermission('store service type');
        ServiceType::create($request->only('name_en','description_en','name_ar','description_ar','price','point_type_id'));
        return redirect()->back()->with(['msg' => 'new service type data is stored', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceType $service_type)
    {
        hasPermission('show service type tags');
        $tags = Tag::withCount(['service_types'=>function($query) use($service_type){
            $query->where('service_type_id',$service_type->id);
        }])->get();
//        dd($tags);
        return view('control_panel.service_types.show',compact('service_type','tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceType $service_type)
    {
        hasPermission('edit service type');
        $point_types = PointType::withCount(['service_types'=>function($query) use($service_type){
            $query->where('id',$service_type->id);
        }])->get();
//        dd($point_types);
        return view('control_panel.service_types.update',compact('service_type','point_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function update(updateServiceTypeRequest $request, ServiceType $serviceType)
    {
        hasPermission('update service type');
        $serviceType->update($request->only('name_en','description_en','name_ar','description_ar','price','point_type_id'));
        return redirect()->back()->with(['msg' => 'a service type data is updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceType $serviceType)
    {
        hasPermission('delete service type');
        $serviceType->delete();
        return redirect()->back()->with(['msg' => 'a service type data is deleted', 'type' => 'success']);
    }
    public function trashedServiceType(){

        hasPermission('show trashed service types');
        $service_types = ServiceType::onlyTrashed()->get();
        $trashTrigger = 1;
        return view('control_panel.service_types.service_types',compact('service_types','trashTrigger'));
    }
    public function restoreServiceType(ServiceType $serviceType){
        hasPermission('restore service type');
        $serviceType->restore();
        return redirect()->back()->with(['msg' => 'a service type data is restored', 'type' => 'success']);
    }
}
