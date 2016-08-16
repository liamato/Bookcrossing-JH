@extends('layout.default')


@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/public.css') }}">
@stop

@section('preJs')
<script type="text/javascript">
    var db = {school: {!! $school->loads('all') !!}, schools:  {!! isset($schools) ? $schools : 'null'!!}, translations:  {!! isset($translations) ? $translations : 'null'!!}, content_css: '{{ asset('/css/public.css') }}', language_url: '{{ asset('js/tinymce.langs.js') }}'};
</script>
@stop


@section('js')
<script src="{{ asset('js/app.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/tinymce.theme.min.css') }}">
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
@stop
