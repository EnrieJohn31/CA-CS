<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Carmel Academy — Cashier &amp; Accounting System">
    <meta name="robots" content="noindex,nofollow">
    <title>{{ config('app.name', 'Carmel Academy Cashier') }}</title>

    <!-- Inter + Source Sans Pro (Inter preferred by theme, Source Sans Pro fallback) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Source+Sans+Pro:wght@300;400;700&display=swap">

    <!-- Font Awesome -->
    <link href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- AdminLTE core -->
    <link href="{{ asset('assets/css/adminlte.min.css') }}" rel="stylesheet">

    <!-- Plugins CSS (only ones actually used) -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">

    <!-- Enhanced Theme (must load last so it can override everything) -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme-enhanced.css') }}?v={{ filemtime(public_path('assets/css/theme-enhanced.css')) }}">

    <!-- Pre-apply theme before first paint to avoid FOUC -->
    <script>
        (function () {
            try {
                var t = localStorage.getItem('cashier_theme') || 'dark';
                document.documentElement.setAttribute('data-theme', t);
                document.documentElement.classList.add(t === 'light' ? 'light-mode' : 'dark-mode');
                document.addEventListener('DOMContentLoaded', function () {
                    document.body.classList.add(t === 'light' ? 'light-mode' : 'dark-mode');
                    document.documentElement.classList.remove('dark-mode', 'light-mode');
                });
            } catch (e) {}
        })();
    </script>

    <!-- Scripts required before body renders (jQuery, Bootstrap, AdminLTE) -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/carmeljs/student.js') }}"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed">
    <a href="#main-content" class="sr-only sr-only-focusable">Skip to main content</a>
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center" aria-hidden="true">
            <img class="animation__wobble" src="{{ asset('assets/img/system/carmel.png') }}" alt=""
                 height="160" width="160" onerror="this.style.display='none'">
        </div>

        @include('body.header')
        @include('body.sidenav')

        <!-- Content Wrapper — each page owns its own section/container -->
        <main id="main-content" class="content-wrapper" role="main" tabindex="-1">
            @yield('content')
        </main>

        @include('body.footer')
    </div>

    <!-- Theme toggle + sidebar behaviour (must be last so DOM is ready) -->
    <script src="{{ asset('assets/js/theme-toggle.js') }}?v={{ filemtime(public_path('assets/js/theme-toggle.js')) }}"></script>
</body>
</html>
