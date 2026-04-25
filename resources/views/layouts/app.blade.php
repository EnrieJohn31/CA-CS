<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <!-- overlayScrollbars -->
  <link href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet">
  <!-- Theme style -->
  <link href="{{ asset('assets/css/adminlte.min.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">

  <!-- Enhanced Theme (Light/Dark) -->
  <link rel="stylesheet" href="{{ asset('assets/css/theme-enhanced.css') }}">
  <script>
      (function () {
          try {
              var t = localStorage.getItem('cashier_theme') || 'dark';
              document.documentElement.setAttribute('data-theme', t);
              // Apply on <html> so CSS fallbacks target something even before <body> exists
              document.documentElement.classList.add(t === 'light' ? 'light-mode' : 'dark-mode');
              document.addEventListener('DOMContentLoaded', function () {
                  document.body.classList.remove('dark-mode', 'light-mode');
                  document.body.classList.add(t === 'light' ? 'light-mode' : 'dark-mode');
                  document.documentElement.classList.remove('dark-mode', 'light-mode');
              });
          } catch (e) {}
      })();
  </script>

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @include('body.js')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item dropdown">


                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('assets/js/theme-toggle.js') }}"></script>
</body>


</html>
