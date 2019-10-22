layui.config({
  base: '/layuiadmin/' //静态资源所在路径
}).extend({
  index: 'lib/index' //主入口模块
}).use(['index', 'table'], function(){
	var $ = layui.$
	,form = layui.form
	,table = layui.table
  ,layer = layui.layer
  ,route = 'permissions';

  	//监听搜索
	form.on('submit(LAY-user-back-search)', function(data){
		var field = data.field;

		//执行重载
		table.reload('LAY-user-back-manage', {
		  where: field
		});
	});

  var load = layer.load(3);
  //表格获取数据
	table.render({
		elem:"#LAY-user-back-manage",
		url:"/"+ route +"_list",
		cols:[[
			{field:"_name",title:"权限名称"},
			{field:"route",title:"权限方法"},
			{field:"sort",title:"排序"},
      {field:"type",templet: function (d) {
          if (d.type == 1) {
              return '<a class="layui-btn layui-btn-primary layui-btn-xs">目录</a>';
          } else if (d.type == 2) {
              return '<a class="layui-btn layui-btn-xs">菜单</a>';
          } else if (d.type == 3){
              return '<a class="layui-btn layui-btn-normal layui-btn-xs">按钮</a>';
          } else {
            return '<a class="layui-btn layui-btn-warm layui-btn-xs">未设置</a>';
          }
      },title:"类型"},
			{field:"created_at",title:"创建时间"},
			{title:"操作",width:150,align:"center",fixed:"right",toolbar:"#table-useradmin-admin"}
			]]
      ,done:function (res) {   //返回数据执行回调函数
        layer.close(load);    //返回数据关闭loading      
      }
	});
	//监听表格事件
	table.on("tool(LAY-user-back-manage)",function(e){
		e.data;
		if("del"===e.event){
			layer.confirm("确定删除此权限？",function(t){
        $.ajax({//异步请求返回给后台
            url:"/"+ route +"/" + e.data.id,
            type:'post',
            data:{'_method':'delete','_token':$('meta[name="csrf-token"]').attr('content')},
            success:function(data){
              console.log(data);
              layer.msg(data.msg, {time: 3000, icon:6});
            }
        });

				e.del(),layer.close(t)
			})
		}else if("edit"===e.event){
			layer.open({
				type:2,
				title:"编辑权限",
				content:"/"+ route +"/"+ e.data.id +"/edit",
				area:["420px","520px"],
				btn:["确定","关闭"],
				yes:function(index, kuner){
          var iframeWindow = window['layui-layer-iframe'+ index]
          ,submitID = 'LAY-user-back-submit'
          ,submit = kuner.find('iframe').contents().find('#'+ submitID);
          //监听提交
          iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
            id = data.field.id;
            //筛选post 中的id
            delete data.field['id'];

            $.ajax({//异步请求返回给后台
                url:"/"+ route +"/"+ id ,
                type:'post',
                data: data.field,
                success:function(data){
                  if(typeof(data) == 'string'){
                    data = eval('(' + data + ')');
                  }
          
                  if(data.status == 400){
                    layer.msg(data.msg, {time: 3000, icon:5});
                  }else{
                    layer.msg(data.msg, {time: 3000, icon:6});
                    table.reload('LAY-user-back-manage'); //数据刷新
                    layer.close(index); //关闭弹层
                  }
                }
            });
          });  
          submit.trigger('click');
				},success: function (kuner,index){
            data = kuner.find('iframe').contents().find('body pre').html();
            if(data){
              data = eval('(' + data + ')');
              if(data.status == 400){
                layer.msg(data.msg, {time: 3000, icon:5});
                layer.close(index); //关闭弹层
              }
            }
          }
			})
		}
	})
  //事件
  var active = {
    add: function(){
      layer.open({
        type: 2
        ,title: '添加权限'
        ,content: "/"+ route +"/create"
        ,area: ['420px', '520px']
        ,btn: ['确定', '取消']
        ,yes: function(index, kuner){
          var iframeWindow = window['layui-layer-iframe'+ index]
          ,submitID = 'LAY-user-back-submit'
          ,submit = kuner.find('iframe').contents().find('#'+ submitID);
          //监听提交
          iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
            $.ajax({//异步请求返回给后台
                url:"/"+ route ,
                type:'post',
                data: data.field,
                success:function(data){
                  if(typeof(data) == 'string'){
                    data = eval('(' + data + ')');
                  }
          
                  if(data.status == 400){
                    layer.msg(data.msg, {time: 3000, icon:5});
                  }else{
                    layer.msg(data.msg, {time: 3000, icon:6});
                    table.reload('LAY-user-back-manage'); //数据刷新
                    layer.close(index); //关闭弹层
                  }
                }
            });
          });  
          submit.trigger('click');
        },success: function (kuner,index){
            data = kuner.find('iframe').contents().find('body pre').html();
            if(data){
              data = eval('(' + data + ')');
              if(data.status == 400){
                layer.msg(data.msg, {time: 3000, icon:5});
                layer.close(index); //关闭弹层
              }
            }
          }
      }); 
    }
  }  
  $('.layui-btn.layuiadmin-btn-admin').on('click', function(){
    var type = $(this).data('type');
    active[type] ? active[type].call(this) : '';
  });





});
