<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Calendar;
use App\City;
use App\Http\Requests\newBranchRequest;
use App\Http\Requests\updateBranchRequest;
use App\Provider;
use App\WeekDay;
use App\WorkDay;
use function foo\func;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Break_;

class ProviderBranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Provider $provider)
    {
        hasPermission('show provider branches');
        $provider->load('branches');
        $trashTrigger = 0;
        return view('control_panel.users.provider.branches.branches',compact('provider','trashTrigger'));
//        dd($provider);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Provider $provider)
    {
        hasPermission('create provider branch');
        $branch = new Branch();
        $branch->provider_id = $provider->id;
        return view('control_panel.users.provider.branches.create',compact('provider','branch'));
//        dd($provider);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newBranchRequest $request)
    {
        hasPermission('store provider branch');
        $branch = Branch::create($request->only('name_en','name_ar','provider_id'));
        Calendar::create(['branch_id'=>$branch->id]);
        return redirect()->back()->with(['msg' => 'branch data stored successfully', 'type' => 'success']);
//        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        hasPermission('edit provider branch');
        return view('control_panel.users.provider.branches.update',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(updateBranchRequest $request, Branch $branch)
    {
        hasPermission('update provider branch');
        $branch->update($request->only('name_en','name_ar','provider_id'));
        return redirect()->back()->with(['msg' => 'branch data stored successfully', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        hasPermission('delete provider branch');
        $branch->delete();
        return redirect()->back()->with(['msg' => 'branch is deleted successfully', 'type' => 'success']);
    }
    public function trashedBranches(Provider $provider){
        hasPermission('show trashed provider branches');
        $provider->load(['branches'=>function($query){
            $query->onlyTrashed();
        }]);
        $trashTrigger = 1;
//        dd($provider);
        return view('control_panel.users.provider.branches.branches',compact('provider','trashTrigger'));
    }
    public function restoreBranch(Branch $branch){
//        dd($branch);
        hasPermission('restore provider branch');
        $branch->restore();
        return redirect()->back()->with(['msg' => 'branch is restored successfully', 'type' => 'success']);
    }
    public function setBranchAsMain(Branch $branch){
//        dd($branch);
        hasPermission('set provider branch as main');
        $main_branch = Branch::where('provider_id',$branch->provider_id)->withTrashed()->where('is_main',1)->first();
        if($main_branch){
            $main_branch->update([
                'is_main'   =>  0
            ]);
        }
        $branch->update([
            'is_main'   =>  1
        ]);
        return redirect()->back()->with(['msg' => 'branch now is main branch', 'type' => 'success']);
    }
    public function setBranchAddress(Branch $branch){
        hasPermission('set provider branch address');
        $marker = 1 ;
        $cities = City::select('id','name_en','name_ar')->get();
        $branch->load(['address'=>function($query) use($branch){
            $query->where('addressable_id',$branch->id)->where('addressable_type','App\Branch');
        },'address.point']);
//        dd($branch);
        $address_trigger = 0;
        if($branch->address){
            $address_trigger = 1;
        }
        $addressable_id = $branch->id;
        $addressable_type = 'Branch';
        $trace_keys = array(
            '0'=>$branch->id,
            '1'=>$branch->provider_id,
            '2'=>0,
        );
        $trace_values = array(
            '0' => 'branches.address',
            '1' => 'branches.index',
            '2' => 'users.providers',
        );
        $trace_words = array(
            '0' => 'branch address',
            '1' => 'provider branches',
            '2' => 'providers',
        );
        $selected_side_item = 'providers';
        return view('control_panel.map',compact('selected_side_item','trace_words','trace_keys','trace_values','address_trigger','branch','addressable_id','addressable_type','cities','marker'));
    }
    /*** start work days ***/
    public function branchWorkDays(Branch $branch){
        hasPermission('show provider branch work days');
        $week_days = WeekDay::with(['calendar'])->withCount(['calendar'=>function($query) use($branch){
            $query->where('calendar_id',$branch->calendar->id);
        }])->get();
//        dd($week_days);
        return view('control_panel.users.provider.branches.work_days',compact('week_days','branch'));
    }
    public function addWeekDayToCalendar($branch_id,$week_day_id,$status){
        hasPermission('change provider branch work day status');
        if($status) {
            $workDay = WorkDay::where('calendar_id',$branch_id->calendar->id)->where('week_day_id',$week_day_id->id)->onlyTrashed()->first();
            if($workDay){
                $workDay->restore();
            }else {
                WorkDay::create([
                    'calendar_id' => $branch_id->calendar->id,
                    'week_day_id' => $week_day_id->id,
                ]);
            }
        }else{
            WorkDay::where('calendar_id',$branch_id->calendar->id)->where('week_day_id',$week_day_id->id)->delete();
        }
    }
    public function set_work_day_customization(Request $request){
        hasPermission('customize provider branch work day data');
        $work_day = WorkDay::find($request->work_day_id);
        if($work_day){
            $work_day->update([
                'max_number'=>$request->max_number,
                'from'=>$request->from,
                'to'=>$request->to,
            ]);
        }
        return response()->json($work_day);
    }
}
