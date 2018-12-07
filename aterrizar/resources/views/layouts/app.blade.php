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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          <i class="fab fa-autoprefixer"></i>
          <!-- {{ config('app.name', 'Aterrizar') }} -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            @if(Auth::user())
            @if(Auth::user()->hasRole('user'))
            <li class="nav-item">
              <a class="nav-link" href="flights"> Buscar Vuelos </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cars"> Buscar Autos </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"> Buscar Hoteles </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"> Mi Carrito </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"> Mis Compras </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/myprofile"> Mi Perfil </a>
            </li>
            @elseif(Auth::user()->hasRole('admin'))
            <li class="nav-item">
             <a class="nav-link" href="../adminpanel"> Panel Configuracion</a>
           </li>
           <li class="nav-item">
            <a class="nav-link" href="../transactions"> Transacciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../givenregistration/create"> Agregar Usuario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../givenregistration"> Usuarios Agregados </a>
          </li>
          @if (empty(Auth::user()->dni))
          <li class="nav-item">
            <a class="nav-link" href="/myprofile"> <mark> Agregar Información Faltante </mark> </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="/myprofile"> Mi Perfil </a>
          </li>
          @elseif(Auth::user()->hasRole('comercial'))
          <li class="nav-item">
           <a class="nav-link" href="../../flights/create"> Agregar Vuelo </a>
         </li>
         <li class="nav-item">
          <a class="nav-link" href="../../cars/create"> Agregar Auto </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../rooms/create"> Agregar Habitacion </a>
        </li>
        @if (empty(Auth::user()->dni))
        <li class="nav-item">
          <a class="nav-link" href="/myprofile"> <mark> Agregar Información Faltante </mark> </a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link" href="/myprofile"> Mi Perfil </a>
        </li>
        @endif
        @endif

      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
        <a class="nav-link" href="../flights"> Buscar Vuelos </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../cars"> Buscar Autos </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../rooms"> Buscar Hoteles </a>
      </li>
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
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    </li>
    @endguest
  </ul>
</div>
</div>
</nav>

<main class="py-4">
  @yield('content')
</main>
</div>
</body>
</html>
