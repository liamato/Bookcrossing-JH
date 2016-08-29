@extends('layout.admin')

@section('preJS')
<script>
    var db = {users: {!! $users !!}, school: "{!! $school->slug !!}" {!! isset($superUser) && $superUser ? ', superuser: true' : '' !!}}
</script>
@stop

@section('main')

<div id="app"></div>

@stop

@section('JS')
<script src="{{ asset('js/admin/user.js') }}"></script>
@stop
