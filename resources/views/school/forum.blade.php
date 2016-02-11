@extends('layout.school')

@section('content')
<p>list de {{$school->name}}</p>
@foreach($posts as $post)
<p>{{ $post->title }} - {{ $post->author }}</p>
@endforeach
<hr>
@foreach($categories as $post)
<p><a href="{{ route('school_forum', [$school->slug, $post->slug]) }}">{{ $post->name }}</a></p>
@endforeach
{{$category}}
@stop