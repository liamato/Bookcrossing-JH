@extends('layout.school')

@section('content')
<p>trailer de {{$school->name}}</p>
@foreach($trailers as $trailer)
<p>{{ $trailer->code }}</p>
@endforeach
@stop