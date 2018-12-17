<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Aterrizar') }}</title>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
    crossorigin="anonymous">
    
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fab fa-autoprefixer fa-2x"></i>
                    {{-- config('app.name', 'Aterrizar') --}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if((Auth::check() and Auth::user()->hasRole('user')) or ! Auth::check())
                        <li class="nav-item {{ Route::currentRouteNamed('flights.index') ? 'active' : '' }}">
                            <a class="nav-link" title="Buscar vuelos" href="{{ route('flights.index') }}">
                                <i class="fas fa-plane fa-lg"></i> Vuelos
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteNamed('cars.index') ? 'active' : '' }}">
                            <a class="nav-link" title="Buscar Autos" href="{{ route('cars.index') }}">
                                <i class="fas fa-car fa-lg"></i> Autos
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteNamed('rooms.index') ? 'active' : '' }}">
                            <a class="nav-link" title="Buscar Hospedaje" href="{{ route('rooms.index') }}">
                                <i class="fas fa-concierge-bell fa-lg"></i> Hospedaje
                            </a>
                        </li>
                        @endif
                        @auth
                        @if(Auth::user()->hasRole('admin'))
                        <li class="nav-item {{ Route::currentRouteNamed('adminpanel.index') ? 'active' : '' }}">
                            <a class="nav-link" title="Configuración" href="{{ route('adminpanel.index') }}">
                                <i class="fas fa-wrench fa-lg"></i> Configuración
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteNamed('transactions') ? 'active' : '' }}">
                            <a class="nav-link" title="Transacciones" href="{{ route('transactions') }}">
                                <i class="fas fa-history fa-lg"></i> Transacciones
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteNamed('givenregistration.index') ? 'active' : '' }}">
                            <a class="nav-link" title="Usuarios" href="{{ route('givenregistration.index') }}">
                                <i class="fas fa-users fa-lg"></i> Usuarios
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteNamed('givenregistration.create') ? 'active' : '' }}">
                            <a class="nav-link" title="Agregar un usuario" href="{{ route('givenregistration.create') }}">
                                <i class="fas fa-user-plus fa-lg"></i> Agregar un usuario
                            </a>
                        </li>
                        @if(empty(Auth::user()->dni))
                        <li class="nav-item">
                            <a class="nav-link" href="/myprofile/create"> <mark>Agregar Información Faltante</mark> </a>
                        </li>
                        @endif
                        @endif
                        @if(Auth::user()->hasRole('comercial'))
                        <li class="nav-item {{ Route::currentRouteNamed('flights.create') ? 'active' : '' }}">
                            <a class="nav-link" title="Agregar vuelos" href="{{ route('flights.create') }}">
                                <i class="fas fa-plane fa-lg"></i> Agregar vuelos
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteNamed('cars.create') ? 'active' : '' }}">
                            <a class="nav-link" title="Agregar Autos" href="{{ route('cars.create') }}">
                                <i class="fas fa-car fa-lg"></i> Agregar autos
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteNamed('rooms.create') ? 'active' : '' }}">
                            <a class="nav-link" title="Agregar Hospedaje" href="{{ route('rooms.create') }}">
                                <i class="fas fa-concierge-bell fa-lg"></i> Agregar hospedaje
                            </a>
                        </li>
                        @if (empty(Auth::user()->dni))
                        <li class="nav-item">
                            <a class="nav-link" href="/myprofile"><mark>Agregar Información Faltante</mark></a>
                        </li>
                        @endif
                        @endif
                        @endauth
                    </ul>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @auth
                        @if(Auth::user()->hasRole('user'))
                        <li class="nav-item  {{ Route::currentRouteNamed('myCart') ? 'active' : '' }}">
                            <a class="nav-link" title="Mi carrito" href="{{ route('myCart') }}">
                                <i class="fas fa-shopping-cart fa-lg"></i>
                                <span class="badge badge-pill badge-danger">{{ session('in_cart') }}</span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteNamed('myShopping') ? 'active' : '' }}">
                            <a class="nav-link" title="Mis compras" href="{{ route('myShopping') }}">
                                <i class="fas fa-history fa-lg"></i>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item {{ Route::currentRouteNamed('myprofile.index') ? 'active' : '' }}">
                            <a class="nav-link" title="Mi perfil" href="{{ route('myprofile.index') }}">
                                <i class="fas fa-user fa-lg"></i>
                            </a>
                        </li>
                        @endauth
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                    
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                    
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>

<main class="py-4">
    @yield('content')
</main>
</div>
</body>

</html>
