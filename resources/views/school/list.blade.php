@extends('layout.school')

@section('content')
<p>list de {{$school->name}}</p>
@foreach($books as $book)
<p>{{ $book->title }} - {{ $book->author }}</p>
@endforeach
@stop