<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\user\SessionRequest;
use App\Services\Administrators\PermissionService;
use App\Models\Role;
use Auth;

class SessionsController extends Controller
{

  public function __construct(PermissionService $permissionService)
  {
      $this->permissionService = $permissionService;
  }
  //登陆界面
	public function create(){
		return view('user.login');
	}

  //登陆
	public function store(SessionRequest $request){
    if (Auth::attempt(['name' => $request->name, 'password' => $request->password],$request->has('remember'))) {
      $this->permissionService->setPermissions();
      return redirect()->route('main.index');
    } else {
      session()->flash('warning', '很抱歉，您的用户名和密码不匹配');
      return redirect()->back()->withInput();
    }
	}

  //退出
  public function destroy(){
      Auth::logout();
      session()->flash('success', '您已成功退出！');
      return redirect('login');
  }

}
