

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layuiAdmin 管理员 iframe 框</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="{{asset('layuiadmin/layui/css/layui.css')}}">
  <link rel="stylesheet" href="{{asset('layuiadmin/layui/css/admin.css')}}">
</head>
<body>

  <div  lay-filter="layuiadmin-form-admin" id="layuiadmin-form-admin" style="padding: 20px 30px 0 0;">
  <form class="layui-form" action="" id="from-submit" method="post">

    {{ csrf_field() }}

    <div class="layui-form-item">
      <label class="layui-form-label">权限定位</label>
      <div class="layui-input-inline">
        <select name="parent_id" lay-filter="LAY-user-adminrole-type">
          <option value="0">顶级权限</option>
          @foreach($permission as $k=>$item)
              <option value="{{$item['id']}}">{!! $item['_name'] !!}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">权限名称</label>
      <div class="layui-input-inline">
        <input type="text" name="name" lay-verify="required" placeholder="请输入权限名称" autocomplete="off" class="layui-input" value="{{old('name')}}">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">权限路由</label>
      <div class="layui-input-inline">
        <input type="text" name="route" placeholder="请输入权限路由" autocomplete="off" class="layui-input" value="{{old('route')}}">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">菜单图标</label>
      <div class="layui-input-inline">
        <input type="text" name="fonts" id="fonts"  value="{{ old('fonts') ? old('fonts') : 'layui-icon-face-smile'}}" autocomplete="off" class="layui-input">
        <a href="https://www.layui.com/doc/element/icon.html" target="_blank">在线查看</a>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">排序</label>
      <div class="layui-input-inline">
        <input type="text" name="sort" lay-verify="required|number" placeholder="请输入权限名称" autocomplete="off" class="layui-input" value="{{old('sort')}}">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">类型</label>
      <div class="layui-input-inline">
        <select name="type" lay-filter="LAY-user-adminrole-type">
          <option value="0"></option>
          <option value="1">目录</option>
          <option value="2">菜单</option>
          <option value="3">按钮</option>
        </select>
      </div>
    </div>

    <div class="layui-form-item layui-hide">
      <input type="button" lay-submit lay-filter="LAY-user-back-submit" id="LAY-user-back-submit" value="确认">
    </div>
  </form>
  </div>

  <script type="text/javascript" src="{{asset('layuiadmin/layui/layui.js')}}"></script>
  @include('commons._layui_error')
  @include('commons._layui_messages')
  <script>
  layui.config({
    base: '/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index','form'], function(){
    var $ = layui.$
    ,form = layui.form 
  })
  </script>
 
</body>
</html>
