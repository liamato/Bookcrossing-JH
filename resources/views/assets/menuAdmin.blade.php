<div class="menu-item {{ \Request::route()->getName() == 'Admin.book.index' ? 'active': ''}}">
                <a href="{{ route('Admin.book.index', $school->slug) }}" class="menu-item--link menu-item--label">Llibres</a>
            </div>
            <!--<div class="menu-item">
                <label for="menu-item--check2" class="menu-item--label">Categories</label>
                <input type="checkbox" class="menu-item--check" {{ \Request::is($school->slug.'/admin/category*') ? 'checked' : ''}} id="menu-item--check2">
                <div class="menu-item menu-item--subitem {{ \Request::route()->getName() == 'Admin.category.index' ? 'active': ''}}">
                    <a href="{{ route('Admin.category.index', $school->slug) }}" class="menu-item--link">Editar</a>
                </div>
                <div class="menu-item menu-item--subitem {{ \Request::route()->getName() == 'Admin.category.move' ? 'active': ''}}">
                    <a href="{{ route('Admin.category.move', $school->slug) }}" class="menu-item--link">Moure posts de categoria</a>
                </div>
            </div>-->
            <div class="menu-item {{ \Request::route()->getName() == 'Admin.category.index' ? 'active': ''}}">
                <a href="{{ route('Admin.category.index', $school->slug) }}" class="menu-item--link menu-item--label">Categories</a>
            </div>

            <div class="menu-item {{ \Request::route()->getName() == 'Admin.post.index' ? 'active': ''}}">
                <a href="{{ route('Admin.post.index', $school->slug) }}" class="menu-item--link menu-item--label">Posts</a>
            </div>
            <div class="menu-item {{ \Request::route()->getName() == 'Admin.news.index' ? 'active': ''}}">
                <a href="{{ route('Admin.news.index', $school->slug) }}" class="menu-item--link menu-item--label">Noticies</a>
            </div>
            @if(!\Auth::user()->isSuper())
            <div class="menu-item {{ \Request::route()->getName() == 'Admin.school.index' ? 'active': ''}}">
                <a href="{{ route('Admin.school.index', $school->slug) }}" class="menu-item--link menu-item--label">Escola</a>
            </div>
            @else
            <div class="menu-item">
                <label for="menu-item--check5" class="menu-item--label">Escola</label>
                <input type="checkbox" class="menu-item--check" {{ (\Request::is($school->slug.'/admin/school*') || \Request::is('admin/school*')) ? 'checked' : ''}} id="menu-item--check5">
                <div class="menu-item menu-item--subitem {{ \Request::route()->getName() == 'Admin.school.index' ? 'active': ''}}">
                    <a href="{{ route('Admin.school.index', $school->slug) }}" class="menu-item--link">Editar</a>
                </div>
                <div class="menu-item menu-item--subitem {{ \Request::route()->getName() == 'SuperAdmin.school.add' ? 'active': ''}}">
                    <a href="{{ route('SuperAdmin.school.add') }}" class="menu-item--link">Afegir</a>
                </div>
            </div>
            @endif
            <div class="menu-item {{ \Request::route()->getName() == 'Admin.user.index' ? 'active': ''}}">
                <a href="{{ route('Admin.user.index', $school->slug) }}" class="menu-item--link menu-item--label">Usuaris</a>
            </div>
            <div class="menu-item {{ \Request::route()->getName() == 'Admin.profile.index' ? 'active': ''}}">
                <a href="{{ route('Admin.profile.index', $school->slug) }}" class="menu-item--link menu-item--label">Perfil</a>
            </div>
            <!--<div class="menu-item">
                <label for="menu-item--check8" class="menu-item--label">Videos</label>
                <input type="checkbox" class="menu-item--check" {{ \Request::is($school->slug.'/admin/video*') ? 'checked' : ''}} id="menu-item--check8">
                <div class="menu-item menu-item--subitem {{ \Request::route()->getName() == 'Admin.video.index' ? 'active': ''}}">
                    <a href="{{ route('Admin.video.index', $school->slug) }}" class="menu-item--link">Editar</a>
                </div>
                <div class="menu-item menu-item--subitem {{ \Request::route()->getName() == 'Admin.video.move' ? 'active': ''}}">
                    <a href="{{ route('Admin.video.move', $school->slug) }}" class="menu-item--link">Moure videos</a>
                </div>
            </div>-->
            <div class="menu-item {{ \Request::route()->getName() == 'Admin.video.index' ? 'active': ''}}">
                <a href="{{ route('Admin.video.index', $school->slug) }}" class="menu-item--link menu-item--label">Videos</a>
            </div>
            <div class="menu-item">
                <a href="{{ route('logout') }}" class="menu-item--link menu-item--label">Tancar sessió</a>
            </div>
