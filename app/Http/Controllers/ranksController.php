<?php

namespace App\Http\Controllers;

use App\Http\Requests\newRankRequest;
use App\Http\Requests\updateRankRequest;
use App\Rank;
use Illuminate\Http\Request;

class ranksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hasPermission('show ranks');
        $ranks = Rank::all();
        $trashTrigger = 0;
        return view('control_panel.ranks.ranks',compact('ranks','trashTrigger'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        hasPermission('create rank');
        $rank = new Rank();
        return view('control_panel.ranks.create',compact('rank'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newRankRequest $request)
    {
        hasPermission('store rank');
        Rank::create($request->only('title_en','title_ar'));
        return redirect()->back()->with(['msg' => 'new rank data is stored', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function show(Rank $rank)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function edit(Rank $rank)
    {
        hasPermission('edit rank');
        return view('control_panel.ranks.update',compact('rank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function update(updateRankRequest $request, Rank $rank)
    {
        hasPermission('update rank');
        $rank->update($request->only('title_en','title_ar'));
        return redirect()->back()->with(['msg' => 'rank data is updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rank $rank)
    {
        hasPermission('delete rank');
        $rank->delete();
        return redirect()->back()->with(['msg' => 'rank data is deleted', 'type' => 'success']);
    }

    public function trashedRanks(){

        hasPermission('show trashed ranks');
        $ranks = Rank::onlyTrashed()->get();
        $trashTrigger = 1;
        return view('control_panel.ranks.ranks',compact('ranks','trashTrigger'));
    }
    public function restoreRank(Rank $rank){
        hasPermission('restore rank');
        $rank->restore();
        return redirect()->back()->with(['msg' => 'rank data is restored', 'type' => 'success']);
    }
}
