@php
$prefix = request()->route()->getPrefix();
$segments = Request::segments();
$routeName = Route::currentRouteName();
$lastSegment = last($segments);

function openMenu($route)
{
$prefix = request()->route()->getPrefix();
return str_contains($prefix, $route)
? 'menu-is-opening menu-open' : '';
}

function thirdLevelValidation($route, $name, $type)
{
switch ($type) {
case 'active':
return ($lastSegment == $name && str_contains($prefix, $route))
? 'active' : '';
break;

case 'icon':
return ($lastSegment == $name && str_contains($prefix, $route))
? 'fa-dot-circle' : 'fa-circle';
break;
}
}

@endphp

<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" title="A.N.N" class="brand-link">
        <img src="{{asset('image/logowhite.png')}}" alt="Logo" class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light">Panel administrador</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ empty(Auth::user()->profile_photo_path) 
                    ? Auth::user()->profile_photo_url 
                    : url("storage/".Auth::user()->profile_photo_path)}}"
                class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.profile') }}" class="d-block">
                    {{ explode(" ", Auth::user()->name)[0] }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @if (Auth::user()->role != 0)

                <li class="nav-item">
                    <a href=" {{ route('admin.dashboard') }} " class="nav-link 
                        {{ $routeName == 'admin.dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Tablero</p>
                    </a>
                </li>

                <li class="nav-item {!! openMenu('administrador/sistema') !!}">
                    <a href="#" class="nav-link {!! $segments[1] == 'sistema' ? 'active' : '' !!}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Sistema
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.button') }}"
                                class="nav-link {!! $routeName == 'admin.button' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.button' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Botones</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user') }}"
                                class="nav-link {!! $routeName == 'admin.user' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.user' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Usuarios</p>
                            </a>
                        </li>                        
                    </ul>
                </li>

                <li class="nav-item {!! openMenu('administrador/catalogo') !!}">
                    <a href="#" class="nav-link {!! $segments[1] == 'catalogo' ? 'active' : '' !!}">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            Catálogo
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.advertisement') }}"
                                class="nav-link {!! $routeName == 'admin.advertisement' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.advertisement' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Anuncios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.tag') }}"
                                class="nav-link {!! $routeName == 'admin.tag' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.tag' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Etiquetas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.category') }}"
                                class="nav-link {!! $routeName == 'admin.category' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.category' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Categorías</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.subcategory') }}"
                                class="nav-link {!! $routeName == 'admin.subcategory' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.subcategory' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Sub categorías</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.photo') }}"
                                class="nav-link {!! $routeName == 'admin.photo' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.photo' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Fotos para galería</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.video') }}"
                                class="nav-link {!! $routeName == 'admin.video' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.video' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Videos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.show') }}"
                                class="nav-link {!! $routeName == 'admin.show' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.show' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Anuncios Espectáculos</p>
                            </a>
                        </li>                        
                        <li class="nav-item">
                            <a href="{{ route('admin.social') }}"
                                class="nav-link {!! $routeName == 'admin.social' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.social' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Redes Sociales</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.poll') }}"
                                class="nav-link {!! $routeName == 'admin.poll' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.poll' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Encuestas</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {!! openMenu('administrador/noticias') !!}">
                    <a href="#" class="nav-link {!! $segments[1] == 'noticias' ? 'active' : '' !!}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Noticias
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.post') }}"
                                class="nav-link {!! $routeName == 'admin.post' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.post' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Notas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ticker') }}"
                                class="nav-link {!! $routeName == 'admin.ticker' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.ticker' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Anuncios Texto</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                
                <li class="nav-item {!! openMenu('administrador/paginas') !!}">
                    <a href="#" class="nav-link {!! $segments[1] == 'paginas' ? 'active' : '' !!}">
                        <i class="nav-icon fas fa-pager"></i>
                        <p>
                            Páginas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.content') }}"
                                class="nav-link {!! $routeName == 'admin.content' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.content' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Contenido</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.faq') }}"
                                class="nav-link {!! $routeName == 'admin.faq' ? 'active' : '' !!}">
                                <i class="far nav-icon 
                                {!! $routeName == 'admin.faq' ? 'fa-dot-circle' : 'fa-circle' !!} "></i>
                                <p>Preguntas</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.profile') }}"
                        class="nav-link {{ $routeName == 'admin.profile' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Perfil</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>