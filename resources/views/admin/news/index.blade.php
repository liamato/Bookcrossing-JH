@extends('layout.admin')

@section('preJS')
<script>
    var db = {news: {!! $news !!}, school: "{!! $school->slug !!}"}
</script>
@stop

@section('main')

<div id="app"></div>

@stop

@section('JS')
<script src="{{ asset('js/admin/news.js') }}"></script>
@stop
