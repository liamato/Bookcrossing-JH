<div class="menu-item">
                <a href="{{ route('Admin.book.index', $school->slug) }}" class="menu-item--link menu-item--label">Llibres</a>
            </div>
            <div class="menu-item">
                <label for="menu-item--check2" class="menu-item--label">Categoria</label>
                <input type="checkbox" class="menu-item--check" id="menu-item--check2">
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.category.index', $school->slug) }}" class="menu-item--link">Editar</a>
                </div>
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.category.move', $school->slug) }}" class="menu-item--link">Moure posts de categoria</a>
                </div>
            </div>
            <div class="menu-item">
                <a href="{{ route('Admin.post.index', $school->slug) }}" class="menu-item--link menu-item--label">Posts</a>
            </div>
            <div class="menu-item">
                <a href="{{ route('Admin.news.index', $school->slug) }}" class="menu-item--link menu-item--label">Noticies</a>
            </div>
            <div class="menu-item">
                <a href="{{ route('Admin.school.index', $school->slug) }}" class="menu-item--link menu-item--label">Escola</a>
            </div>
            <div class="menu-item">
                <a href="{{ route('Admin.user.index', $school->slug) }}" class="menu-item--link menu-item--label">Usuaris</a>
            </div>
            <div class="menu-item">
                <a href="{{ route('Admin.profile.index', $school->slug) }}" class="menu-item--link menu-item--label">Perfil</a>
            </div>
            <div class="menu-item">
                <label for="menu-item--check8" class="menu-item--label">Videos</label>
                <input type="checkbox" class="menu-item--check" id="menu-item--check8">
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.video.index', $school->slug) }}" class="menu-item--link">Editar</a>
                </div>
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.video.move', $school->slug) }}" class="menu-item--link">Moure videos</a>
                </div>
            </div>
