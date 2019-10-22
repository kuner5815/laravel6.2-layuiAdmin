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
    <link href="{{asset('/plugins/alert/toastr.min.css')}}" rel="stylesheet">
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <fieldset class="layui-elem-field layuimini-search">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">角色</label>
                            <div class="layui-input-inline">
                                <input type="text" name="name" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">排序</label>
                            <div class="layui-input-inline">
                                <input type="text" name="sort" autocomplete="off" class="layui-input">
                            </div>
                        </div>

                        <div class="layui-inline">
                            <a class="layui-btn" lay-submit lay-filter="LAY-user-back-search">搜索</a>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>

      <div class="layui-btn-group">
        <div>
          <button class="layui-btn layuiadmin-btn-admin" data-type="add">添加</button>
          <button class="layui-btn layuiadmin-btn-admin layui-btn-danger" data-type="batchdel">删除</button>
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
          <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
          @{{#  if(d.name == 'admin'){ }}
            <a class="layui-btn layui-btn-disabled layui-btn-xs"><i class="layui-icon layui-icon-delete"></i>删除</a>
          @{{#  } else { }}
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
          @{{#  } }}
        </script>
      
    </div>
</div>
 
<script type="text/javascript" src="{{asset('layuiadmin/layui/layui.js')}}"></script>
<script type="text/javascript" src="{{edition('js/user/role/index.js')}}"></script>

</body>
</html>

