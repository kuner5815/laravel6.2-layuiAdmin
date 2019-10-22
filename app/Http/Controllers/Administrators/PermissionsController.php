<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\administrators\PermissionRequest;
use Illuminate\Http\Request;
use App\Services\Administrators\PermissionService;
use App\Models\Permission;

class PermissionsController extends Controller
{
	public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index(){
        //zz($this->permissionService->getAdminPermissionTree());
    	$permission = $this->permissionService->getPermissionTree();
		return view('user.permission.index',compact('permission'));
    }

    public function create(){
    	$permission = $this->permissionService->getPermissionTree();
		return view('user.permission.create',compact('permission'));    	
    }

    public function store(PermissionRequest $request ,Permission $permission){
        $permission->fill($request->except(['_token']));
        $permission->save();
        return response()->json(['status' => '200','msg' =>'创建成功！']);
    }

    public function edit(Permission $permission){
        $permission_select = $this->permissionService->getPermissionTree();
        return view('user.permission.edit',compact('permission','permission_select'));
    }

    public function update(Permission $permission ,PermissionRequest $request){
        $permission->fill($request->except(['_token','_method']));
        $permission->save();
        //更新权限
        $this->permissionService->setPermissions();
        return response()->json(['status' => '200','msg' =>'更新成功！']);
    }

    public function destroy(Permission $permission){
        $permission->delete();
        return response()->json(['status' => '200','msg' =>'删除成功！']);
    }
    
    public function list(Request $request){
        $permission = $this->permissionService->getPermissionTree();
        return ['code' => 0 , 'count' => 0,'data' => array_values($permission)];
    }
}
