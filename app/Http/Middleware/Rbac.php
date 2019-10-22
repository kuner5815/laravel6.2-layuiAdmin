<?php

namespace App\Http\Middleware;
use App\Services\Administrators\PermissionService;
use Closure;
use Auth;


class Rbac
{
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //登陆验证
        if(!Auth::check()){
            return redirect('login');
        }
        //dd(\Route::currentRouteName());
        //按钮权限验证
        if(Auth::user()->id != 1){
            $permissions = $this->permissionService->getAdminPermissionList();
            //dd(\Route::currentRouteName());
            if(!in_array(\Route::currentRouteName(),$permissions)){
                return response()->json(['status' => '400','msg' =>'很抱歉，无权访问！']);
            }
        }
        return $next($request);
    }
}
