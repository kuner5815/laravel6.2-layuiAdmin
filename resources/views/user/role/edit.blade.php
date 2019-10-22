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

  <div class="layui-form" lay-filter="layuiadmin-form-admin" id="layuiadmin-form-admin" style="padding: 20px 30px 0 0;">
  <form>
    <input type='hidden' value='{{ $role->id }}' name='id'>
    {{ method_field('PATCH') }}
    {{ csrf_field() }}

    <div class="layui-form-item">
      <label class="layui-form-label">角色名称</label>
      <div class="layui-input-inline">
        <input type="text" name="name" placeholder="请输入角色名称" autocomplete="off" class="layui-input" value="{{ $role->name }}">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">角色描述</label>
      <div class="layui-input-inline">
        <textarea name="remark" class="layui-textarea" rows="5" cols="20" data-msg-required="请输入角色描述">{{ $role->remark }}</textarea>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">排序</label>
      <div class="layui-input-inline">
        <input type="text" name="sort" placeholder="请输入角色排序" autocomplete="off" class="layui-input" value="{{ $role->sort }}">
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