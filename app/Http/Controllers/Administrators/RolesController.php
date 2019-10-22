<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\administrators\RoleRequest;
use Illuminate\Http\Request;
use App\Services\Administrators\RoleService;
use App\Models\Role;
use Auth;
class RolesController extends Controller
{

	public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

	public function index(){
		return view('user.role.index');
	}

	public function create(){
		return view('user.role.create');
	}

	public function edit(Role $role){
		return view('user.role.edit',compact('role'));
	}

	public function store(RoleRequest $request,Role $role){
        $role->fill($request->except(['_token']));
        $role->save();
        return response()->json(['status' => '200','msg' =>'创建成功！']);
	}

	public function update(RoleRequest $request ,Role $role ){
        $role->fill($request->except(['_token','_method']));
        $role->save();
        return response()->json(['status' => '200','msg' =>'更新成功！']);
	}

	public function destroy(Role $role){
		$role->delete();
        return response()->json(['status' => '200','msg' =>'删除成功！']);
	}

	public function multipleDestroy(Request $request){
		Role::whereIn('id',$request->ids)->delete();
		return response()->json(['status' => '200','msg' =>'可多选成功删除角色！']);
	}
	public function list(Request $request){
		$data = $this->roleService->list($request);
		return ['code' => 0 , 'count' => $data['count'],'data' => $data['list'] ];
	}
}
