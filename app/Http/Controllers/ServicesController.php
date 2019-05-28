<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Category;
use App\Http\Requests\newServiceRequest;
use App\Http\Requests\updateServiceRequest;
use App\Service;
use App\ServiceTag;
use App\Tag;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpParser\Node\Stmt\Break_;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Branch $branch)
    {
        hasPermission('show services');
        $branch->load('services.category');
        $trashTrigger = 0;
        return view('control_panel.users.provider.branches.services.services',compact('branch','trashTrigger'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Branch $branch)
    {
        hasPermission('create service');
        $categories = Category::where('is_leaf',1)->get();
        $service = new Service();
        return view('control_panel.users.provider.branches.services.create',compact('categories','branch','service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newServiceRequest $request)
    {
//        dd(array_merge($request->all(),['expired_at'=>Carbon::now()]));
        hasPermission('store service');
        Service::create(array_merge($request->all(),['expired_at'=>Carbon::now()->toDateString()]));
        return redirect()->back()->with(['msg'=>'service stored successfully','type'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        hasPermission('show service tags');
        $tags = Tag::withCount(['services'=>function($query) use($service){
            $query->where('service_id',$service->id);
        }])->get();
//        dd($tags);
        return view('control_panel.users.provider.branches.services.tags',compact('tags','service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        hasPermission('edit service');
        $categories = Category::where('is_leaf',1)->get();
        $branch = Branch::find($service->branch_id);
        return view('control_panel.users.provider.branches.services.update',compact('categories','branch','service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(updateServiceRequest $request, Service $service)
    {
        hasPermission('update service');
        $service->update($request->only('name_en','description_en','name_ar','description_ar','category_id'));
        return redirect()->back()->with(['msg'=>'service updated successfully','type'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        hasPermission('delete service');
        $service->delete();
        return redirect()->back()->with(['msg'=>'service deleted successfully','type'=>'success']);
    }
    public function trashedServices (Branch $branch){
        hasPermission('show trashed services');
        $branch->load(['services'=>function($query){
            $query->onlyTrashed();
        },'services.category']);
        $trashTrigger = 1;
//        dd($branch);
        return view('control_panel.users.provider.branches.services.services',compact('branch','trashTrigger'));
    }
    public function restoreService (Service $service){
        hasPermission('restore service');
        $service->restore();
        return redirect()->back()->with(['msg'=>'service restored successfully','type'=>'success']);
    }
    public function addTagToService($service,$tag,$status){
        hasPermission('change service tag status');
        if($status){
            ServiceTag::create([
                'service_id'   =>  $service->id,
                'tag_id'            =>  $tag->id
            ]);
        }else{
            ServiceTag::where('service_id',$service->id)->where('tag_id',$tag->id)->delete();
        }
    }
}
