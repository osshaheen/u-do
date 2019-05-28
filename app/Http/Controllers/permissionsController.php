<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class permissionsController extends Controller
{
    public function addNewPermission($permission){
//        Permission::create(['name' => $permission]);
    }
    public function addNewRole($role){
        Role::create(['name' => $role]);
    }
    public function addAllPermissionsToRole($role_id){
        Role::find($role_id)->syncPermissions(Permission::all());
    }
    public function addRoleToUser(User $user){
        $user->assignRole('super admin');
    }
    public function addPermissionToUser(User $user,$permission_id){
        $user->givePermissionTo(Permission::all());
    }

}
