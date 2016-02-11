<!DOCTYPE html>
<html lang="{{ $lang or 'ca'}}">
	<head>
		<meta charset="utf-8"> 
		<title>{{ $title or (isset($school)? 'Bookcrossing '.$school->name : 'Bookcrossing')}}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		@yield('css')
		@yield('preJs')
	</head>
	<body>
		<div class="container" id="container">
			<a href="{{ url('/') }}">public</a>
			<a href="{{ route('school_home', $school->slug) }}">home</a>
			<a href="{{ route('school_news', $school->slug) }}">news</a>
			<a href="{{ route('school_list', $school->slug) }}">list</a>
			<a href="{{ route('school_capture', $school->slug) }}">capture</a>
			<a href="{{ route('school_liberate', $school->slug) }}">liberate</a>
			<a href="{{ route('school_register', $school->slug) }}">register</a>
			<a href="{{ route('school_forum', $school->slug) }}">forum</a>
			<a href="{{ route('school_trailer', $school->slug) }}">trailer</a>
			<a href="{{ route('school_tube', $school->slug) }}">tube</a>
			@yield('content')
		</div>
		@yield('js')
	</body>
</html>