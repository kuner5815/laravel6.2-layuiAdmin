<?php

namespace App\Services\Administrators;
use App\Models\Role;
use App\Models\Permission;
use Auth;

class RolePermissionLinkService{

    public function setPermissions(){
        //超级管理员
        if(Auth::user()->id == 1){
            $permissions = Permission::all();
            $permissions = json_encode($permissions);
        }else{
            $permissions = Role::find(Auth::user()->role_id)->link;
            $permissions = json_encode($permissions);            
        }

        session(['permission_'.Auth::user()->role_id => $permissions]);
    }

    public function getPermissions(){
        return json_decode(session()->get('permission_'.Auth::user()->role_id),true);  
    }    

}

?>