<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', isset($title) ? $title : "" )</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script>
        function getCookie(name) {
            var pattern = RegExp(name + "=.[^;]*")
            matched = document.cookie.match(pattern)
            if (matched) {
                var cookie = matched[0].split('=')
                return decodeURIComponent(cookie[1])
            }
            return false
        }
    </script>
    @yield('CSS')
    @yield('preJS')

</head>
<body>
    <div class="gloval">
        <nav class="nabar">
            @if(\Auth::user()->isSuper())
                <select id="school-nav">
                    @foreach(\App\School::all() as $sc)
                        <option value="{{$sc->slug}}" {{$sc->id === $school->id ? 'selected' : ''}}>{{$sc->name}}</option>
                    @endforeach
                </select>
            @else
                <a href="{{route('Admin.index', $school->slug)}}">Home</a>
            @endif
        </nav>
        <aside class="menu">
            @include('assets.menuAdmin')
        </aside>
        <main class="main">
@yield('main')
        </main>
    </div>
    @if(\Auth::user()->isSuper())
        <script>
            (function(){
                var sel = document.getElementById('school-nav')
                sel.addEventListener('change',function(){
                    window.location = "{!!route('Admin.index','#school#')!!}".replace('#school#',sel.value)
                })
            })()
        </script>
    @endif
    @yield('JS')
</body>
</html>
