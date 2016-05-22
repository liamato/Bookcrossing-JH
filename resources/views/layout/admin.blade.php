<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', isset($title) ? $title : "" )</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('CSS')
    @yield('preJS')

</head>
<body>
    <div class="gloval">
        <nav class="nabar">
            <a href="{{route('Admin.index', $school->slug)}}">Home</a>
        </nav>
        <aside class="menu">
            @include('assets.menuAdmin')
        </aside>
        <main class="main">
@yield('main')
        </main>
    </div>
    @yield('JS')
</body>
</html>
