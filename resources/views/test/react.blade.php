@extends('layout.default')


@section('preJs')
<script src="{{ asset('js/app.js') }}" async></script>
<script type="text/javascript">
function httpReq(meth, loc, ret){
	if(!ret){ret = 'all'}
	var req = new XMLHttpRequest();
		req.open(meth, loc, false);
		req.send();
	if(ret == 'all'){

		var headers = req.getAllResponseHeaders();
		headers = headers.split(/\n/);

		for(i = 0; i < headers.length; i++){
			headers[i] = headers[i].split(": ");
		}

		return headers

	}else {
		return req;
	}
}

	//config = JSON.parse(httpReq('GET', '/api/v1/school/modi','alla').responseText);


	</script>
@stop


@section('js')
	<script type="text/javascript">
		//{{$school}}
		//config = JSON.parse(decodeHtmlEntities("{{$school}}")); 
	</script>
@stop