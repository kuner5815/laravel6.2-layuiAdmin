@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(session()->has($msg))
<script type="text/javascript" src="{{asset('layuiadmin/layui/layui.js')}}"></script>
<script type="text/javascript">
layui.use(['form'], function () {
    var form = layui.form,
        layer = layui.layer,
        icon = 6;
        @if($msg == 'warning'){
        	icon = 5
        }
        @endif
        layer.msg('{{ session()->get($msg) }}', {time: 3000, icon:icon});
});
</script>
@endif
@endforeach