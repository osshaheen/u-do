<?php

namespace App\Http\Controllers;

use App\Http\Requests\newWeekDayRequest;
use App\Http\Requests\updateWeekDayRequest;
use App\WeekDay;
use Illuminate\Http\Request;

class weekDaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hasPermission('show week days');
        $weekDays = WeekDay::all();
        $trashTrigger = 0;
        return view('control_panel.week_days.week_days',compact('weekDays','trashTrigger'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        hasPermission('create week day');
        $weekDay = new WeekDay();
        return view('control_panel.week_days.create',compact('weekDay'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newWeekDayRequest $request)
    {
        hasPermission('store week day');
        WeekDay::create($request->only('day_en','day_ar'));
        return redirect()->back()->with(['msg'=>'week day data is stored successfully', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WeekDay  $weekDay
     * @return \Illuminate\Http\Response
     */
    public function show(WeekDay $weekDay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WeekDay  $weekDay
     * @return \Illuminate\Http\Response
     */
    public function edit(WeekDay $weekDay)
    {
        hasPermission('edit week day');
        return view('control_panel.week_days.update',compact('weekDay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WeekDay  $weekDay
     * @return \Illuminate\Http\Response
     */
    public function update(updateWeekDayRequest $request, WeekDay $weekDay)
    {
        hasPermission('update week day');
        $weekDay->update($request->only('day_en','day_ar'));
        return redirect()->back()->with(['msg'=>'week day data is updated successfully', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WeekDay  $weekDay
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeekDay $weekDay)
    {
        hasPermission('delete week day');
        $weekDay->delete();
        return redirect()->back()->with(['msg'=>'week day data is deleted successfully', 'type' => 'success']);
    }
    public function trashedWeekDays()
    {
        hasPermission('show trashed week days');
        $weekDays = WeekDay::onlyTrashed()->get();
        $trashTrigger = 1;
        return view('control_panel.week_days.week_days',compact('weekDays','trashTrigger'));
    }
    public function restoreWeekDay(WeekDay $weekDay)
    {
        hasPermission('restore week day');
        $weekDay->restore();
        return redirect()->back()->with(['msg'=>'week day data is restored successfully', 'type' => 'success']);
    }
}
