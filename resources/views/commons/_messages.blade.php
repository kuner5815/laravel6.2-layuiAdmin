@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(session()->has($msg))
	<link href="{{asset('/plugins/alert/toastr.min.css')}}" rel="stylesheet">
  <script src="{{asset('/js/jquery-2.1.1.js')}}"></script>
  <script src="{{asset('/plugins/alert/toastr.min.js')}}"></script>
  <script type="text/javascript">
	lk_say('{{ $msg }}','{{ session()->get($msg) }}'); //'info,success,warning,error'
  </script>
@endif
@endforeach