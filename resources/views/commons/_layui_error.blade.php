@if (count($errors) > 0)
  <span id='show_msg_span' style="display: none">
    @foreach($errors->all() as $error)
      {{$error}}|
    @endforeach
  </span>

<script type="text/javascript">
layui.use(['form', 'layedit', 'laydate','table'], function(){
	var show_msg_span = document.getElementById('show_msg_span').innerText;
	show_msg_span = show_msg_span.replace(/\|/g, "<br>")
	layer.msg(show_msg_span, {time: 3000, icon:5});
	// layer.msg(show_msg_span, function(){
	// //关闭后的操作
	// });
})
</script>
@endif