<?php

namespace App\Http\Controllers;

use App\Http\Requests\newTagRequest;
use App\Http\Requests\updateTagRequest;
use App\ServiceTypeTag;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hasPermission('show tags');
        $tags = Tag::all();
        $trashTrigger = 0;
        return view('control_panel.tags.tags',compact('tags','trashTrigger'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        hasPermission('create tag');
        $tag = new Tag();
        return view('control_panel.tags.create',compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newTagRequest $request)
    {

        hasPermission('store tag');
        Tag::create($request->only('name_en','name_ar'));
        return redirect()->back()->with(['msg' => 'new tag data is stored', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        hasPermission('edit tag');
        return view('control_panel.tags.update',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(updateTagRequest $request, Tag $tag)
    {
        hasPermission('update tag');
        $tag->update($request->only('name_en','name_ar'));
        return redirect()->back()->with(['msg' => 'a tag data is updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        hasPermission('delete tag');
        $tag->delete();
        return redirect()->back()->with(['msg' => 'a tag data is deleted', 'type' => 'success']);
    }
    public function trashedTag(){

        hasPermission('show trashed tags');
        $tags = Tag::onlyTrashed()->get();
        $trashTrigger = 1;
        return view('control_panel.tags.tags',compact('tags','trashTrigger'));
    }
    public function restoreTag(Tag $tag){
        hasPermission('restore tag');
        $tag->restore();
        return redirect()->back()->with(['msg' => 'a tag data is restored', 'type' => 'success']);
    }
    public function addTagToServiceType($service_type,$tag,$status){
        hasPermission('change service type tag status');
        if($status){
            ServiceTypeTag::create([
                'service_type_id'   =>  $service_type->id,
                'tag_id'            =>  $tag->id
            ]);
        }else{
            ServiceTypeTag::where('service_type_id',$service_type->id)->where('tag_id',$tag->id)->delete();
        }
    }
}
