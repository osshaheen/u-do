<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Http\Requests\newExceptionWorkingDayRequest;
use App\Http\Requests\updateExceptionWorkingDayRequest;
use App\WorkExceptionDate;
use Illuminate\Http\Request;

class ExceptionWorkingDaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Branch $branch)
    {
        hasPermission('show work exceptions dates');
        $branch->load('exceptionWorkingDays');
        $trashTrigger = 0;
        return view('control_panel.users.provider.branches.exception_working_days.exception_working_days',compact('branch','trashTrigger'));
//        dd($branch);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Branch $branch)
    {
        hasPermission('create work exceptions date');
        $exceptionWorkingDay = new WorkExceptionDate();
        return view('control_panel.users.provider.branches.exception_working_days.create',compact('branch','exceptionWorkingDay'));
//        dd($branch);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newExceptionWorkingDayRequest $request)
    {
        hasPermission('store work exceptions date');
        WorkExceptionDate::create($request->only('day','branch_id'));
        return redirect()->back()->with(['msg' => 'new exception working day data is stored', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkExceptionDate  $workExceptionDate
     * @return \Illuminate\Http\Response
     */
    public function show(WorkExceptionDate $workExceptionDate)
    {
        //        dd($workExceptionDate);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkExceptionDate  $workExceptionDate
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkExceptionDate $exceptionWorkingDay)
    {
        hasPermission('edit work exceptions date');
        $branch = Branch::find($exceptionWorkingDay->branch_id);
        return view('control_panel.users.provider.branches.exception_working_days.update',compact('branch','exceptionWorkingDay'));
//        dd($workExceptionDate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkExceptionDate  $workExceptionDate
     * @return \Illuminate\Http\Response
     */
    public function update(updateExceptionWorkingDayRequest $request, WorkExceptionDate $workExceptionDate)
    {
        hasPermission('update work exceptions date');
        $workExceptionDate->update($request->only('day','branch_id'));
        return redirect()->back()->with(['msg' => 'new exception working day data is updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkExceptionDate  $workExceptionDate
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkExceptionDate $workExceptionDate)
    {
//        dd($workExceptionDate);
        hasPermission('delete work exceptions date');
        $workExceptionDate->delete();
        return redirect()->back()->with(['msg' => 'exception working day data is deleted', 'type' => 'success']);
    }
    public function restoreExceptionWorkingDay(WorkExceptionDate $workExceptionDate){
        hasPermission('restore work exceptions date');
        $workExceptionDate->restore();
        return redirect()->back()->with(['msg' => 'deleted exception working day data is restored', 'type' => 'success']);
    }
    public function trashedExceptionWorkingDays(Branch $branch){
        hasPermission('show trashed work exceptions date');
        $branch->load(['exceptionWorkingDays'=>function($query){
            $query->onlyTrashed();
        }]);
        $trashTrigger = 1;
        return view('control_panel.users.provider.branches.exception_working_days.exception_working_days',compact('branch','trashTrigger'));
    }
}
