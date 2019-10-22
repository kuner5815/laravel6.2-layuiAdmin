<?php

namespace App\Services\Administrators;
use App\Models\Role;


class RoleService{

	public function list($request){
		// 创建一个查询构造器
        $builder = Role::query();

        //角色筛选
        if($request->name){
        	$builder->where('name', $request->name);
        }

        //排序
        if($request->sort){
        	$builder->where('sort', $request->order);
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
        	'list' => $builder->offset($startrow)->limit($pagesize)->get()
        ];
	}
}

?>