@extends('layout.school')

@section('content')
<p>trailer de {{$school->name}}</p>
@foreach($tubes as $tube)
<p>{{ $tube->code }}</p>
@endforeach
@stop