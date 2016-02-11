<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Tria el teu centre - Bookcrossing</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="container">
			@foreach($schools as $school)
				<a href="{{ route('school_home', $school->slug) }}">{{ $school->name }}</a>
			@endforeach
		</div>
	</body>
</html>