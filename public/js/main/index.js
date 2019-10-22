
layui.use(['form'], function () {
    var form = layui.form,
        layer = layui.layer,
        $ = layui.$;


    $('#admin_info').on('click', function(){
        var id = $(this).data('id');
        route = 'admins';
        layer.open({
            type:2,
            title:"编辑管理员",
            content:"/"+ route +"/"+ id ,
            area:["420px","420px"],
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
    });
})