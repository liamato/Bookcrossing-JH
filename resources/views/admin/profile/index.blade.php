@extends('layout.admin')

@section('preJS')
<script>
    var db = {user: {!! $user !!}}
</script>
@stop

@section('main')

<div id="app"></div>

@stop

@section('JS')
<script src="{{ asset('js/admin/profile.js') }}"></script>
@stop
