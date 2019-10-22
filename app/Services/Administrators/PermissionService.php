<?php

namespace App\Services\Administrators;
use App\Models\Permission;
use App\Handlers\Tree;
use App\Models\Role;
use Auth;

class PermissionService{
    public function setPermissions(){
        //超级管理员
        if(Auth::user()->id == 1){
            $permissions = Permission::orderBy('sort')->get();
            $permissions = json_encode($permissions);
        }else{
            $permissions = Role::find(Auth::user()->role_id)->link->sortBy('sort');
            $permissions = json_encode($permissions);            
        }

        session(['permission_'.Auth::user()->role_id => $permissions]);
    }

    static function getAdminPermissionList(){
        $permission = json_decode(session()->get('permission_'.Auth::user()->role_id),true);
        $list = [];
        foreach ($permission as $key => $value) {
            if($value['route']){
                $list[] = $value['route'];
            }
        }
        return $list;
    } 

    static function getAdminPermissionTree(){
        $permissions = json_decode(session()->get('permission_'.Auth::user()->role_id),true);
        return Tree::array_tree($permissions ? $permissions : []);  
    } 

	public function getPermissionTree(){
        $permission = Permission::get()->toArray();
        return Tree::tree($permission,'name','id','parent_id');
	}
}

?>