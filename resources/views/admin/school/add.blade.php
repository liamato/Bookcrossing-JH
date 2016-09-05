@extends('layout.admin')

@section('preJS')
<script>
    var db = {schools: {!! $school->all() !!}, users: {!! $users !!}, categories: [], placeholderUrl: '{!! route('School.home', ':school:') !!}', redirectplaceholderurl: '{!! route('Admin.index', ':school:') !!}'}
</script>
@stop

@section('main')

<div id="app"></div>

@stop

@section('JS')
<script src="{{ asset('js/admin/school-add.js') }}"></script>
@stop
