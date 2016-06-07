@extends('layout.admin')

@section('preJS')
<script>
    var db = {categories: {!! $categories !!}, school: "{!! $school->slug !!}"}
</script>
@stop

@section('main')

<div id="app"></div>

@stop

@section('JS')
<script src="{{ asset('js/admin/category.js') }}"></script>
@stop
