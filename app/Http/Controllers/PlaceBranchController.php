<?php

namespace App\Http\Controllers;

use App\Address;
use App\Branch;
use App\City;
use App\Http\Requests\newPlaceBranchRequest;
use App\Http\Requests\updatePlaceBranchRequest;
use App\Place;
use App\PlaceBranch;
use App\PlaceDetails;
use Illuminate\Http\Request;

class PlaceBranchController extends Controller
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
        hasPermission('create place branch');
        $branch = new Branch();
        $details_exists = 0;
        return view('control_panel.places.branches.create',compact('place','branch','details_exists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newPlaceBranchRequest $request)
    {
        hasPermission('store place branch');
        $place_branch = PlaceBranch::create($request->only('name_en','name_ar','place_id'));
//        dd($request->toArray()['property_en']);
        $data = $request->toArray();
        if(isset($data['property_en'])) {
            for ($i = 0; $i < count($data['property_en']); $i++) {
                if ($data['property_en'][$i]&&$data['property_ar'][$i]) {
                    PlaceDetails::create([
                        'property_en' => $data['property_en'][$i],
                        'value_en' => $data['value_en'][$i],
                        'property_ar' => $data['property_ar'][$i],
                        'value_ar' => $data['value_ar'][$i],
                        'branch_id' => $place_branch->id
                    ]);
                }
            }
        }
        return redirect()->back()->with(['msg' => 'new place branch data is stored', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PlaceBranch  $placeBranch
     * @return \Illuminate\Http\Response
     */
    public function show(PlaceBranch $placeBranch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PlaceBranch  $placeBranch
     * @return \Illuminate\Http\Response
     */
    public function edit($place_branch_id)
    {
//        dd($place_branch_id);
        hasPermission('edit place branch');
        $branch = PlaceBranch::find($place_branch_id);
        if($branch) {
            $place = Place::find($branch->place_id);
            $details = PlaceDetails::where('branch_id',$place_branch_id)->get();
//            dd($details);
            $details_exists = 1;
            if($place) {
                return view('control_panel.places.branches.update', compact('place', 'branch','details','details_exists'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PlaceBranch  $placeBranch
     * @return \Illuminate\Http\Response
     */
    public function update(updatePlaceBranchRequest $request,$place_branch_id)
    {
//        dd($request);
        hasPermission('update place branch');
        $branch = PlaceBranch::findOrFail($place_branch_id);
        $branch->update($request->only('name_en','name_ar'));
        $data = $request->toArray();
//        dd($data);
        if(isset($data['property_en'])) {
            for ($i = 0; $i < count($data['property_en']); $i++) {
                if ($data['property_en'][$i]) {
                    $place_branch_details = 0;
//                    dd($place_branch_details);
                    if (isset($request->details_id[$i])) {
                        $place_branch_details = PlaceDetails::find($request->details_id[$i]);
                    }
                    if ($place_branch_details) {
                        $place_branch_details->update([
                            'property_en' => $data['property_en'][$i],
                            'value_en' => $data['value_en'][$i],
                            'property_ar' => $data['property_ar'][$i],
                            'value_ar' => $data['value_ar'][$i],
                            'branch_id' => $place_branch_id
                        ]);
                    } else {
                        PlaceDetails::create([
                            'property_en' => $data['property_en'][$i],
                            'value_en' => $data['value_en'][$i],
                            'property_ar' => $data['property_ar'][$i],
                            'value_ar' => $data['value_ar'][$i],
                            'branch_id' => $place_branch_id
                        ]);
                    }
                }
            }
        }
        return redirect()->back()->with(['msg' => 'a place branch data is updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PlaceBranch  $placeBranch
     * @return \Illuminate\Http\Response
     */
    public function destroy($place_branch_id)
    {
        hasPermission('delete place branch');
        PlaceBranch::destroy($place_branch_id);
        return redirect()->back()->with(['msg' => 'a place branch data is deleted', 'type' => 'success']);
    }
    public function deleteDetail($place_branch_detail_id)
    {
        hasPermission('delete place branch details');
        PlaceDetails::destroy($place_branch_detail_id);
        return response()->json(['msg' => 'a place branch details is deleted', 'type' => 'success']);
    }
    public function trashedPlaceBranches(Place $place){

        hasPermission('show trashed place branches');
        $place->load(['branches'=>function($query) use($place){
            $query->onlyTrashed()->where('place_id',$place->id);
        }]);
//        dd($place);
        $trashTrigger = 1;
        return view('control_panel.places.branches.branches',compact('place','trashTrigger'));
    }
    public function restorePlaceBranch(PlaceBranch $placeBranch){
        hasPermission('restore place branch');
        $placeBranch->restore();
        return redirect()->back()->with(['msg' => 'a branch data is restored', 'type' => 'success']);
    }
    public function setPlaceBranchMain(PlaceBranch $placeBranch){
//        dd($placeBranch);
        hasPermission('set place branch as main');
        $placeBranches = PlaceBranch::where('place_id',$placeBranch->place_id)->where('is_main',1)->first();
        if($placeBranches){
            $placeBranches->update(['is_main'=>0]);
//            dd($placeBranches);
        }
        $placeBranch->update(['is_main'=>1]);
//        dd($placeBranch);
        return redirect()->back()->with(['msg' => 'selected branch now is main', 'type' => 'success']);
    }
    public function addAddress(PlaceBranch $branch){
        hasPermission('add address for place branch');
        $marker = 1 ;
        $cities = City::select('id','name_en','name_ar')->get();
        $branch->load(['address'=>function($query) use($branch){
            $query->where('addressable_id',$branch->id)->where('addressable_type','App\PlaceBranch');
        },'address.point']);
        $address_trigger = 0;
        if($branch->address){
            $address_trigger = 1;
        }
        $addressable_id = $branch->id;
        $addressable_type = 'PlaceBranch';
        $trace_keys = array(
            '0'=>$branch->id,
            '1'=>$branch->place_id,
            '2'=>0,
        );
        $trace_values = array(
            '0' => 'places.branch.addAddress',
            '1' => 'places.show',
            '2' => 'places.index',
        );
        $trace_words = array(
            '0' => 'place address',
            '1' => 'places branches',
            '2' => 'places',
        );
        $selected_side_item = 'places';
        return view('control_panel.map',compact('selected_side_item','trace_words','trace_keys','trace_values','address_trigger','branch','addressable_id','addressable_type','cities','marker'));
    }
}
