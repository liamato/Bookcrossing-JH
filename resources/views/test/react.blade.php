@extends('layout.default')


@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/public.css') }}">
@stop

@section('preJs')
<script type="text/javascript">
    var db = {school: {!! $school->loads('all') !!}, schools:  {!! isset($schools) ? $schools : 'null'!!}, translations:  {!! isset($translations) ? $translations : 'null'!!}};
</script>
@stop


@section('js')
<script src="{{ asset('js/app.js') }}"></script>
@stop
