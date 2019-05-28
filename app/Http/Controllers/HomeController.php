<?php

namespace App\Http\Controllers;

use App\Address;
use App\addressPoint;
use App\City;
use App\Http\Requests\newMediaRequest;
use App\Media;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect(route('users.index'));
//        return view('home');
    }
    public function addPicture(newMediaRequest $request){
        hasPermission('add picture');
//        if($request->mediable_type == 'App\\User'||$request->mediable_type == 'App\\Provider'){
//        return response(5);
            $file = $request->file('file')->store('public','public');
            $media = Media::where('mediable_type',$request->mediable_type)->where('mediable_id',$request->mediable_id)->first();
            if($media){
                $media->update([
                    'type' => $request->file('file')->getClientOriginalExtension(),
                    'path' => $file
                ]);
            }else{
                Media::create([
                    'mediable_type' => $request->mediable_type,
                    'mediable_id' => $request->mediable_id,
                    'type' => $request->file('file')->getClientOriginalExtension(),
                    'path' => $file
                ]);
            }
//        }
        return response()->json($file);
    }
    public function getCitiesForMap(){
        $cities = City::select('id','name')->get();
        return response()->json($cities);
    }
    //$address = Address::create($request->only('addressable_type','addressable_id','city_id','type','detailed_address'));

//        addressPoint::create([
//            'lat'=>$data['points']['lat'],
//            'lng'=>$data['points']['lng'],
//            'address_id'=>$address->id
//        ]);
    public function addMarker(Request $request){
        hasPermission('add marker');
        $data = $request->toArray();
        $data['points'] = json_decode($request->points);
//        $address = Address::create([$request->only('addressable_type','addressable_id','city_id','type','detailed_address')]);
        $address = Address::create([
            'addressable_type'  =>  $data['addressable_type'],
            'addressable_id'    =>  $data['addressable_id'],
            'city_id'           =>  $data['city_id'],
            'type'              =>  $data['type'],
            'detailed_address'  =>  $data['detailed_address'] ? $data['detailed_address'] : ''
        ]);
//        return response()->json($address);
        addressPoint::create([
            'lat'           =>  $data['points']->lat,
            'lng'           =>  $data['points']->lng,
            'address_id'    =>  $address->id,
        ]);
        return response()->json($address->id);
    }
    public function updateMarker(Request $request){
        hasPermission('update marker');
        $data = $request->toArray();
//        return response()->json($data);
        $data['points'] = json_decode($request->points);
        $address = Address::with('point')->find($data['id']);
        $address->update([
            'addressable_type'  =>  $data['addressable_type'],
            'addressable_id'    =>  $data['addressable_id'],
            'city_id'           =>  $data['city_id'],
            'type'              =>  $data['type'],
            'detailed_address'  =>  $data['detailed_address'] ? $data['detailed_address'] : ''
        ]);
//
        $address->point->update([
            'lat'=>$data['points']->lat,
            'lng'=>$data['points']->lng
        ]);
        return response()->json('updated');
    }
}
