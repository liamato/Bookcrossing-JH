@extends('layout.admin')

@section('preJS')
<script>
    var db = {books: {!! $books !!}, school: "{!! $school->slug !!}", csrf: "{{ csrf_token() }}"}
</script>
@stop

@section('main')

<div id="app"></div>
{{--@foreach($books as $book)

    <div>{{ $book->title}}</div>

@endforeach--}}
@stop

@section('JS')
<script src="{{ asset('js/admin/book.js') }}"></script>
@stop
