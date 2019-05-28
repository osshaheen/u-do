<?php

namespace App\Http\Controllers;

use App\Http\Requests\newPackageRequest;
use App\Http\Requests\updatePackageRequest;
use App\Package;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hasPermission('show packages');
        $packages = Package::all();
        $trashTrigger = 0;
        return view('control_panel.packages.packages',compact('packages','trashTrigger'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        hasPermission('create package');
        $package = new Package();
        return view('control_panel.packages.create',compact('package'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newPackageRequest $request)
    {
//        dd($request);
        hasPermission('store package');
        Package::create($request->only('name_en','name_ar','description_en','description_ar','points'));
        return redirect()->back()->with(['msg' => 'new package data is stored', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        hasPermission('edit package');
        return view('control_panel.packages.update',compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(updatePackageRequest $request, Package $package)
    {
        hasPermission('update package');
        $package->update($request->only('name_en','name_ar','description_en','description_ar','points'));
        return redirect()->back()->with(['msg' => 'a package data is updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        hasPermission('delete package');
        $package->delete();
        return redirect()->back()->with(['msg' => 'a package data is deleted', 'type' => 'success']);
    }
    public function restorePackage(Package $package){
//        dd($package);
        hasPermission('restore package');
        $package->restore();
        return redirect()->back()->with(['msg' => 'a package data is restored', 'type' => 'success']);
    }
    public function trashedPackages(){
        hasPermission('show trashed packages');
        $packages = Package::onlyTrashed()->get();
        $trashTrigger = 1;
        return view('control_panel.packages.packages',compact('packages','trashTrigger'));
    }
}
