<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\administrators\AdminRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use App\Services\Administrators\AdminService;
use Auth;


class AdminsController extends Controller
{

	public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

	public function index(){
		$role = Role::all();
		return view('user.administrator.index',compact('role'));
	}

	public function show(Admin $admin){
		$role = Role::all();
		return view('user.administrator.show',compact('admin','role'));
	}

	public function create(){
		$role = Role::all();
		return view('user.administrator.create',compact('role'));
	}

	public function store(AdminRequest $request){

		Admin::create([
			'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => bcrypt($request->password),
        ]);

		return response()->json(['status' => '200','msg' =>'创建成功！']);
	}

	public function edit(Admin $admin){
		$role = Role::all();
		return view('user.administrator.edit',compact('admin','role'));
	}

	public function update(Admin $admin ,AdminRequest $request){
		$data = [];
		$data['name'] = $request->name;
		if($request->email){
			$data['email'] = $request->email;
		}
		if($request->password){
			$data['password'] = bcrypt($request->password);
		}
		if($request->role_id){
			$data['role_id'] = $request->role_id;
		}
        $admin->update($data);
		return response()->json(['status' => '200','msg' =>'更新成功！']);
	}

	public function destroy(Admin $admin){
        $admin->delete();
        return response()->json(['status' => '200','msg' =>'删除成功！']);
	}

	public function multipleDestroy(Request $request){
		Admin::whereIn('id',$request->ids)->delete();
		return response()->json(['status' => '200','msg' =>'可多选成功删除角色！']);
	}
	
	public function list(Request $request){
		$data = $this->adminService->list($request);
		return ['code' => 0 , 'count' => $data['count'],'data' => $data['list'] ];
	}
}
