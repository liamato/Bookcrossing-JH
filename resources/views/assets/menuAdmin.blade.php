<div class="menu-item">
                <label for="menu-item--check1" class="menu-item--label">Llibres</label>
                <input type="checkbox" class="menu-item--check" id="menu-item--check1">
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.book.index', $school->slug) }}" class="menu-item--link">Home</a>
                </div>
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.book.edit', $school->slug) }}" class="menu-item--link">Editar</a>
                </div>
            </div>
            <div class="menu-item">
                <label for="menu-item--check2" class="menu-item--label">Categoria</label>
                <input type="checkbox" class="menu-item--check" id="menu-item--check2">
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.category.index', $school->slug) }}" class="menu-item--link">Home</a>
                </div>
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.category.edit', $school->slug) }}" class="menu-item--link">Editar</a>
                </div>
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.category.move', $school->slug) }}" class="menu-item--link">Moure posts de categoria</a>
                </div>
            </div>
            <div class="menu-item">
                <label for="menu-item--check3" class="menu-item--label">Posts</label>
                <input type="checkbox" class="menu-item--check" id="menu-item--check3">
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.post.index', $school->slug) }}" class="menu-item--link">Home</a>
                </div>
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.post.edit', $school->slug) }}" class="menu-item--link">Editar</a>
                </div>
            </div>
            <div class="menu-item">
                <label for="menu-item--check4" class="menu-item--label">Noticies</label>
                <input type="checkbox" class="menu-item--check" id="menu-item--check4">
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.news.index', $school->slug) }}" class="menu-item--link">Home</a>
                </div>
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.news.edit', $school->slug) }}" class="menu-item--link">Editar</a>
                </div>
            </div>
            <div class="menu-item">
                <a href="{{ route('Admin.school.index', $school->slug) }}" class="menu-item--link menu-item--label">Escola</a>
            </div>
            <div class="menu-item">
                <label for="menu-item--check6" class="menu-item--label">Usuaris</label>
                <input type="checkbox" class="menu-item--check" id="menu-item--check6">
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.user.index', $school->slug) }}" class="menu-item--link">Home</a>
                </div>
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.user.edit', $school->slug) }}" class="menu-item--link">Editar</a>
                </div>
            </div>
            <div class="menu-item">
                <a href="{{ route('Admin.profile.index', $school->slug) }}" class="menu-item--link menu-item--label">Perfil</a>
            </div>
            <div class="menu-item">
                <label for="menu-item--check8" class="menu-item--label">Videos</label>
                <input type="checkbox" class="menu-item--check" id="menu-item--check8">
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.video.index', $school->slug) }}" class="menu-item--link">Home</a>
                </div>
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.video.edit', $school->slug) }}" class="menu-item--link">Editar</a>
                </div>
                <div class="menu-item menu-item--subitem">
                    <a href="{{ route('Admin.video.move', $school->slug) }}" class="menu-item--link">Moure videos</a>
                </div>
            </div>
