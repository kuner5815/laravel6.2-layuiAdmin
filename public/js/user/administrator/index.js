layui.config({
  base: '/layuiadmin/' //静态资源所在路径
}).extend({
  index: 'lib/index' //主入口模块
}).use(['index', 'table'], function(){
	var $ = layui.$
	,form = layui.form
	,table = layui.table
  ,layer = layui.layer
  ,route = 'admins';
  	//监听搜索
	form.on('submit(LAY-user-back-search)', function(data){
		var field = data.field;

		//执行重载
		table.reload('LAY-user-back-manage', {
		  where: field
		});
	});
  //var load = layer.load(3);
  //表格获取数据
	table.render({
		elem:"#LAY-user-back-manage",
		url:"/"+ route +"_list",
		cols:[[
			{type:"checkbox",fixed:"left"},
			{field:"id",width:80,title:"ID",sort:!0},
			{field:"name",title:"登录名"},
			{field:"email",title:"邮箱"},
			{field:"role_name",title:"角色"},
			{field:"created_at",title:"加入时间",sort:!0},
			{title:"操作",width:150,align:"center",fixed:"right",toolbar:"#table-useradmin-admin"}
			]],
      page :true
      ,limit: 10
      ,done:function (res) {   //返回数据执行回调函数
        layer.close(load);    //返回数据关闭loading      
      }
	});
	//监听表格事件
	table.on("tool(LAY-user-back-manage)",function(e){
		e.data;
		if("del"===e.event){
			//layer.prompt({formType:1,title:"敏感操作，请验证口令"},function(t,i){
				//layer.close(i),
				layer.confirm("确定删除此管理员？",function(t){
          $.ajax({//异步请求返回给后台
              url:"/"+ route +"/" + e.data.id,
              type:'post',
              data:{'_method':'delete','_token':$('meta[name="csrf-token"]').attr('content')},
              success:function(data){
                  if(data.status == 400){
                    layer.msg(data.msg, {time: 3000, icon:5});
                  }else{
                    layer.msg(data.msg, {time: 3000, icon:6});
                    layer.close(index); //关闭弹层
                  }
                  table.reload('LAY-user-back-manage'); //数据刷新
              }
          });

					e.del(),layer.close(t)
				})
			//})
		}else if("edit"===e.event){
			layer.open({
				type:2,
				title:"编辑管理员",
				content:"/"+ route +"/"+ e.data.id +"/edit",
				area:["420px","510px"],
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
    batchdel: function(){
      var checkStatus = table.checkStatus('LAY-user-back-manage')
      ,checkData = checkStatus.data; //得到选中的数据

      if(checkData.length === 0){
        return layer.msg('请选择数据');
      }
      
      layer.prompt({
        formType: 1
        ,title: '敏感操作，请验证口令'
      }, function(value, index){
        layer.close(index);
        
        layer.confirm('确定删除吗？', function(index) {
          //执行 Ajax 后重载
          var ids = {},is_admin = 0;
          $.each(checkStatus.data, function(i, val) {  
            if(val.id == 1){
              is_admin = 1
              layer.msg('超级管理员你也敢删？胆子不小啊！', {time: 3000, icon:5});
            }else{
              ids[i] = val.id;
            }
          }); 
          
          if(!is_admin){
            $.ajax({//异步请求返回给后台
                url:"/"+ route +"/multipleDestroy" ,
                type:'post',
                data:{'_token':$('meta[name="csrf-token"]').attr('content'),ids:ids},
                success:function(data){
                  if(data.status == 400){
                    layer.msg(data.msg, {time: 3000, icon:5});
                  }else{
                    layer.msg(data.msg, {time: 3000, icon:6});
                    layer.close(index); //关闭弹层
                  }
                  table.reload('LAY-user-back-manage'); //数据刷新
                }
            });
          }
        });
      }); 
    }
    ,add: function(){
      layer.open({
        type: 2
        ,title: '添加管理员'
        ,content: "/"+ route +"/create"
        ,area: ['420px', '510px']
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
