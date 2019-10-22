

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
      <form >
          <input type='hidden' value='{{ $role->id }}' name='id'>
          {{ method_field('PATCH') }}
          {{ csrf_field() }}
          <div class="form-group">
              <table class="layui-table" style="border:1px solid red">
                  @foreach($datas as $k=>$item)
                      @if(empty($item->_data))
                          <tr class="b-group">
                              <th>
                                  <center>
                                    <label>&nbsp;&nbsp;{{$item->name}}&nbsp;
                                        <input type="checkbox" name="permission_id[]" value="{{$item->id}}" lay-ignore onclick="checkAll(this)"  @if(in_array($item->id,$permission)) checked="checked" @endif>
                                    </label>
                                  </center>
                              </th>
                              <td></td>
                          </tr>
                      @else
                          <tr class="b-group">
                              <th width="10%">
                                  <label>&nbsp;&nbsp;{{$item->name}}&nbsp;<input type="checkbox" name="permission_id[]" lay-ignore value="{{$item->id}}" @if(in_array($item->id,$permission)) checked="checked" @endif onclick="checkAll(this)">
                                  </label>
                              </th>
                              <td class="b-child">
                                  @foreach($item->_data as $key=>$value)
                                      <table  style="width: 100%">
                                          <tr class="b-group">
                                              <th width="10%">
                                                  <label>
                                                      {{$value->name}}&nbsp;<input type="checkbox" lay-ignore name="permission_id[]" value="{{$value->id}}" @if(in_array($value->id,$permission)) checked="checked" @endif onclick="checkAll(this)">
                                                  </label>
                                              </th>
                                              <td>
                                                  @if(!empty($value->_data))
                                                      @foreach($value->_data as $val)
                                                          <label>
                                                              &emsp;{{$val->name}} <input type="checkbox" lay-ignore name="permission_id[]" value="{{$val->id}}" @if(in_array($val->id,$permission)) checked="checked" @endif>
                                                          </label>
                                                      @endforeach
                                                  @endif
                                              </td>
                                          </tr>
                                      </table>
                                  @endforeach
                              </td>
                          </tr>
                      @endif
                  @endforeach
              </table>
              <div class="layui-form-item layui-hide">
                <input type="button" lay-submit lay-filter="LAY-user-back-submit" id="LAY-user-back-submit" value="确认">
              </div>
          </div>
      </form>
  </div>

  <script type="text/javascript" src="{{asset('layuiadmin/layui/layui.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
  
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

  function checkAll(obj){
      $(obj).parents('.b-group').eq(0).find("input[type='checkbox']").prop('checked', $(obj).prop('checked'));
  }
  </script>
 
</body>
</html>