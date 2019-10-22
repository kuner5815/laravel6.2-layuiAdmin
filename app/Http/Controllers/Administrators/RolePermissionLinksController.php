<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Administrators\RolePermissionLinkService;
use App\Models\Permission;
use App\Models\Role;
use App\Handlers\Tree;

class RolePermissionLinksController extends Controller
{
	public function __construct(RolePermissionLinkService $rolePermissionLinkService)
    {
        $this->rolePermissionLinkService = $rolePermissionLinkService;
    }
    //权限分配页面
    public function edit($id){
        //角色信息
        $role = Role::find($id);
        //获取全部数据格式化
        $datas = Tree::channelLevel(Permission::orderBy('sort','asc')->get(), 0, '&nbsp;', 'id','parent_id');
        //获取拥有的权限
        $permission = $role->link()->pluck('permission_id')->toArray();
        //zz($hasPermission);
        return view('user.role_permission_link.edit',compact('permission','datas','role'));
    }

    public function update(Request $request,$id){
        Role::find($id)->link()->sync($request->get('permission_id'));
        return response()->json(['status' => '200','msg' =>'配置成功！']);
    }

    public function getMenus(){
        dd(123);
    }
}
