@extends('layout.admin')

@section('preJS')
<script>
    var db = {videos: {!! $videos !!}, school: "{!! $school->slug !!}"}
</script>
@stop

@section('main')

<div id="app"></div>

@stop

@section('JS')
<script src="{{ asset('js/admin/video.js') }}"></script>
@stop
