@extends('layout.school')

@section('content')
<p>news de {{$school->name}}</p>
@foreach($news as $new)
<p>{{ $new->title }} - {{ $new->author }}</p>
@endforeach
@stop