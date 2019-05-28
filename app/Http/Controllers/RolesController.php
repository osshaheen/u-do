<?php

namespace App\Http\Controllers;

use App\Http\Requests\newRoleRequest;
use App\Http\Requests\updateRoleRequest;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        hasPermission('');
        $roles = Role::all();
        $trashTrigger = 0;
        return view('control_panel.roles.roles',compact('roles','trashTrigger'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $role = new Role();
        return view('control_panel.roles.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(newRoleRequest $request)
    {
        Role::create($request->only('name'));
        return redirect()->back()->with(['msg' => 'new role data is stored', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
//        dd($role);
        return view('control_panel.roles.update',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateRoleRequest $request, Role $role)
    {
        $role->update($request->only('name'));
        return redirect()->back()->with(['msg' => 'a role data is updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with(['msg' => 'role data is deleted', 'type' => 'success']);
    }
    public function trashedRoles(){
        $roles = Role::onlyTrashed()->get();
        $trashTrigger = 1;
        return view('control_panel.roles.roles',compact('roles','trashTrigger'));
    }
    public function restoreRole(Role $role){
        $role->restore();
        return redirect()->back()->with(['msg' => 'role data is restored', 'type' => 'success']);
    }
    public function rolePermissions(Role $role){
        $permissions = Permission::withCount(['roles'=>function($query) use($role){
            $query->where('role_id',$role->id);
        }])->get();
//        dd($permissions);
        return view('control_panel.roles.permissions',compact('role','permissions'));
    }

    public function addPermissionToRole(Role $role,Permission $permission,$status){
        $role = Role::withCount(['permissions'=>function($query) use($permission){
            $query->where('permission_id',$permission->id);
        }])->find($role->id);
        if($role->permissions_count){
            if($status){
//                $role->givePermissionTo($permission);
            }else {
                $role->revokePermissionTo($permission);
//                return 'ازالة';
            }
        }else{
            if($status){
                $role->givePermissionTo($permission);
//                return 'اضافة';
            }else {
//                $role->revokePermissionTo($permission);
            }
        }

    }
    public function userRoles(User $user){
        $roles = Role::withCount(['users'=>function($query) use($user){
            $query->where('model_type','App\User')->where('model_id',$user->id);
        }])->where('id','!=',1)->get();
        return view('control_panel.users.roles',compact('roles','user'));
    }
    public function userPermissions(User $user){
        $permissions = Permission::withCount(['users'=>function($query) use($user){
            $query->where('model_type','App\User')->where('model_id',$user->id);
        }])->where('id','!=',1)->get();
        return view('control_panel.users.permissions',compact('permissions','user'));
    }
    public function addRoleToUser(User $user,Role $role,$status){
        $role = Role::withCount(['users'=>function($query) use($user){
            $query->where('model_type','App\User')->where('model_id',$user->id);
        }])->find($role->id);
        if($role->users_count){
            if($status){
//                $role->givePermissionTo($permission);
            }else {
                $user->removeRole($role);
                return 'ازالة';
            }
        }else{
            if($status){
                $user->assignRole($role);
                return 'اضافة';
            }else {
//                $role->revokePermissionTo($permission);
            }
        }
    }
    public function addPermissionToUser(User $user,Permission $permission,$status){
        $permission = Permission::withCount(['users'=>function($query) use($user){
            $query->where('model_type','App\User')->where('model_id',$user->id);
        }])->find($permission->id);
        if($permission->users_count){
            if($status){
//                $role->givePermissionTo($permission);
            }else {
                $user->revokePermissionTo($permission);
                return 'ازالة';
            }
        }else{
            if($status){
                $user->givePermissionTo($permission);
                return 'اضافة';
            }else {
//                $role->revokePermissionTo($permission);
            }
        }
    }
}
