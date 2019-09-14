<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="/{{ env('URL_REMOTE', '') }}js/app.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="/{{ env('URL_REMOTE', '') }}vendor/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="/{{ env('URL_REMOTE', '') }}css/app.css" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                          <li class="nav-item"><a class="nav-link" href="{{ route('rubros.index') }}">Rubros</a></li>
                          <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Categorías</a></li>
                          <li class="nav-item"><a class="nav-link" href="{{ route('stockproducts.index') }}">Productos Stock</a></li>
                          <li class="nav-item"><a class="nav-link" href="{{ route('stockproducts.saleproducts.index', 0) }}">Lista de Precios</a></li>
                          <li class="nav-item"><a class="nav-link" href="{{ route('proveedors.index') }}">Proveedores</a></li>
                          <li class="nav-item"><a class="nav-link" href="{{ route('clients.index') }}">Clientes</a></li>
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
          @if(session('error'))
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
              </div>
            </div>
          </div>
          <script>
            $('.alert').delay(4000).fadeOut(1000, function() {
              $(this).alert('close');
            });
          </script>
          @endif
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>
