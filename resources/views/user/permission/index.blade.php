<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layuiAdmin 后台管理员</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('layuiadmin/layui/css/layui.css')}}" media="all">
  <link rel="stylesheet" href="{{asset('layuiadmin/layui/css/admin.css')}}" media="all">
  <link rel="stylesheet" href="{{asset('layuiadmin/layui/css/public.css')}}" media="all">

</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
      <div class="layui-btn-group">
        <div>
          <button class="layui-btn layuiadmin-btn-admin" data-type="add">添加</button>
        </div>
      </div>  
      <table id="LAY-user-back-manage" lay-filter="LAY-user-back-manage"></table>  
        <script type="text/html" id="buttonTpl">
          @{{#  if(d.check == true){ }}
            <button class="layui-btn layui-btn-xs">已审核</button>
          @{{#  } else { }}
            <button class="layui-btn layui-btn-primary layui-btn-xs">未审核</button>
          @{{#  } }}
        </script>
        <script type="text/html" id="table-useradmin-admin">
          @{{#  if(d.name == '主页' || d.name == '控制台' || d.name == '权限管理' || d.name == '管理员' || d.name == '角色'  || d.name == '权限'){ }}
            <a class="layui-btn layui-btn-disabled layui-btn-xs"><i class="layui-icon layui-icon-edit"></i>编辑</a>
            <a class="layui-btn layui-btn-disabled layui-btn-xs"><i class="layui-icon layui-icon-delete"></i>删除</a>
          @{{#  } else { }}
            <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
          @{{#  } }}
        </script>
    </div>
</div>

<script type="text/javascript" src="{{asset('layuiadmin/layui/layui.js')}}"></script>
<script type="text/javascript" src="{{edition('js/user/permission/index.js')}}"></script>
</body>
</html>

