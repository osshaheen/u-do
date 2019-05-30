<?php

namespace App\Http\Controllers;

use App\Http\Requests\createUserRequest;
use App\Http\Requests\updateProviderRequest;
use App\Http\Requests\updateUserRequest;
use App\Provider;
use App\Rank;
use App\ServiceType;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hasPermission('show users');
        $users = User::with('image')->withCount('provider')->get();
//        dd($users);
        $trashTrigger = 0;
        return view('control_panel.users.users',compact('users','trashTrigger'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        hasPermission('create user');
        $user = new User();
//        dd();
        return view('control_panel.users.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createUserRequest $request)
    {
        hasPermission('store user');
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
//        $input['phone_verified_at'] = Date::now();
        $user = User::create($input);
        if($request->provider_name){
            $user->provider()->create([
                'name_en'      =>  $request->provider_name_en,
                'name_ar'      =>  $request->provider_name_ar,
            ]);
        }
        return redirect()->back()->with(['msg' => 'new user data is stored', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        hasPermission('edit user');
        $user->load('provider');
//        dd($user);
        return view('control_panel.users.update',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(updateUserRequest $request, User $user)
    {
        //
        hasPermission('update user');
        if($request->password) {
            $user->update($request->only('username_en','username_ar', 'phone', 'email', 'language','password'));
        }else{
            $user->update($request->only('username_en','username_ar', 'phone', 'email', 'language'));
        }
        if($request->provider_name_en&&$request->provider_name_ar){
            $user->provider()->update([
                'name_en'      =>  $request->provider_name_en,
                'name_ar'      =>  $request->provider_name_ar
            ]);
        }
        return redirect()->back()->with(['msg' => 'a user data is updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        hasPermission('delete user');
//        dd($user->hasRole('super admin'));
        if(!$user->hasRole('super admin')) {
            $user->delete();
//            dd(1);
            return redirect()->back()->with(['msg' => 'a user data is deleted', 'type' => 'success']);
        }else{
            return redirect()->back()->with(['msg' => 'super admin can\'t be deleted', 'type' => 'warning']);
        }
    }
    public function makeProvider(User $user){
        hasPermission('user make provider');
        if($user->provider()->count()) {
            return redirect()->back()->with(['msg' => 'user is already a provider', 'type' => 'warning']);
        }else{
            $user->provider()->create([
                'user_id'   => $user->id
            ]);
            return redirect()->back()->with(['msg' => 'converted to provider', 'type' => 'success']);
        }
    }
    public function trashedUsers(){
        hasPermission('show trashed users');
        $users = User::onlyTrashed()->get();
        $trashTrigger = 1;
        return view('control_panel.users.users',compact('users','trashTrigger'));
    }
    public function restoreUsers(User $user){
        hasPermission('restore user');
        $user->restore();
        $trashTrigger = 1;
        return redirect()->back()->with(['msg' => 'user data restored successfully', 'type' => 'success']);
    }
    public function blockUser(User $user,$status){
        hasPermission('block user');
        $user->update(['is_blocked'=>$status]);
        return response()->json(['msg' => 'user data restored successfully', 'type' => 'success']);
    }
    public function getProviderDetails(Provider $provider){
        hasPermission('get provider details');
        $provider->load(['views','user','ratings.reviews']);
        $ranks = Rank::withCount(['providers'=>function($query)use($provider){
            $query->where('id',$provider->id);
        }])->get();
        $service_types = ServiceType::withCount(['providers'=>function($query)use($provider){
            $query->where('id',$provider->id);
        }])->get();
//        dd($provider->views);
        return view('control_panel.users.provider.provider_details',compact('provider','ranks','service_types'));
    }
    public function usersProviderEdit(Provider $provider,$trigger = 1){
        hasPermission('user provider edit');
        return view('control_panel.users.provider.provider_edit',compact('provider','trigger'));
//        dd($provider);
    }
    public function providers(){
        hasPermission('show providers');
        $providers = Provider::with(['user','ranks','service_type'])->whereHas('user')->get();
        $ranks = Rank::all();
        $service_types = ServiceType::all();
//        dd($providers,$ranks,$service_types);
        return view('control_panel.users.provider.providers',compact('providers','ranks','service_types'));
    }
    public function updateUserProvider(updateProviderRequest $request,Provider $provider){
        hasPermission('update provider');
        $provider->update($request->only('name_en','bio_en','name_ar','bio_ar'));
        return redirect()->back()->with(['msg' => 'Provider data updated successfully', 'type' => 'success']);

//        dd($request);
    }
    public function getProviderViews(Provider $provider){
        hasPermission('get provider views');
        $provider->load(['views'=>function($query){
            $query->whereNull('views.deleted_at');
        }]);
//        dd($provider);
    }
    public function change_provider_rank(Provider $provider,$rank_id){
//        return response()->json($rank_id);
        hasPermission('change provider rank');
        if($rank_id==='null') {
            $provider->update(['rank_id' => null]);
        }else{
            $provider->update(['rank_id' => $rank_id->id]);
        }
    }
    public function change_provider_service_type(Provider $provider,$service_type_id){
        hasPermission('change provider service type');
        if($service_type_id==='null') {
            $provider->update(['service_type_id' => null]);
        }else{
            $provider->update(['service_type_id'=>$service_type_id->id]);
        }
    }
}
