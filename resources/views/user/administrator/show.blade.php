

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
    <form class="layui-form">
      <input type="hidden" name="id" value="{{ $admin->id }}">
      {{ method_field('PATCH') }}
      {{ csrf_field() }}
      <div class="layui-form-item">
        <label class="layui-form-label">登陆名</label>
        <div class="layui-input-block">
          <input type="text" name="name" autocomplete="off" placeholder="请输入登陆名称" class="layui-input" value="{{ $admin->name }}">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">邮箱</label>
        <div class="layui-input-block">
          <input type="text" name="email" autocomplete="off" placeholder="请输入邮箱" class="layui-input" value="{{ $admin->email }}">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-inline" style="width: 70%">
          <input type="password" name="password" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">请填写6到12位密码</div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">确认密码</label>
        <div class="layui-input-inline" style="width: 70%">
          <input type="password" name="password_confirmation" placeholder="请再次输入密码" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">请填写6到12位密码</div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">角色</label>
        <div class="layui-input-block">
            @if(1 == $admin->id)
              <input type="text" autocomplete="off" class="layui-input" value="超级管理员" disabled="">
            @else
              @foreach($role as $k=>$v)
                @if($v->id == $admin->role_id)
                  <input type="text" autocomplete="off" class="layui-input" value="{{ $v->name }}" disabled="">
                @endif
              @endforeach
            @endif
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