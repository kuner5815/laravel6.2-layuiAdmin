<?php

namespace App\Services\Administrators;
use App\Models\User;


class AdminService{

	public function list($request){
		// 创建一个查询构造器
        $builder = User::leftjoin('roles','users.role_id','roles.id');

        //用户名筛选
        if($request->name){
        	$builder->where('users.name', $request->name);
        }

        //邮箱筛选
        if($request->email){
        	$builder->where('users.email', $request->email);
        }

        //角色筛选
        if($request->role_id){
            $builder->where('users.role_id', $request->role_id);
        }
        //分页的相关变量  
       	$pagesize = $request->limit; //每页显示条数  
        //获取地址栏中传递的page参数  
        if(empty($request->page))  
        {  
            $page = 1;  
            $startrow = 0;  
        }else 
        {  
            $page = (int)$request->page;  
            $startrow = ($page-1)*$pagesize;  
        }  

        return [
        	'count' => $builder->count(),
        	'list' => $builder->select('users.id','users.name','users.email','users.created_at','roles.name as role_name')->offset($startrow)->limit($pagesize)->orderBy('users.id')->get()
        ];
	}
}

?>