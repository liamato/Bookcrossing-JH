@extends('layout.admin')

@section('preJS')
<script>
    var db = {school: {!! $school !!}}
</script>
@stop

@section('main')

<div id="app"></div>

@stop

@section('JS')
<script src="{{ asset('js/admin/school.js') }}"></script>
@stop
