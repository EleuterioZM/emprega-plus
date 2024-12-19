<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>
    <!-- Estilos do Tabler -->
    <link rel="preload" href="{{ asset('css/tabler.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('css/outras-estilos.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/outras-estilos.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Para o Data Picker-->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
       <!-- Inclua o cabeçalho apenas se não estiver nas páginas de login ou cadastro -->
       @unless(
    request()->routeIs('register') ||
    request()->routeIs('verification.notice') ||
    request()->routeIs('verification.verify') ||
    request()->routeIs('password.request') ||
    request()->routeIs('password.email') ||
    request()->routeIs('password.reset') ||
    request()->routeIs('password.update') ||
    request()->routeIs('login') ||
    request()->routeIs('logout') ||
    request()->routeIs('verify')
)
    @include('layouts.header') <!-- Inclui o cabeçalho -->
@endunless


    <div class="page">
        @yield('content')
    </div>

    <!-- Scripts do Tabler -->
    <script src="{{ asset('js/tabler.min.js') }}"></script>
    <script src="{{ asset('js/danger_modal.js') }}"></script>
    <script src="{{ asset('js/outras-scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr('#date-picker', {
                dateFormat: 'Y-m-d',
                locale: "pt",
            });
        });
    </script>
</body>
@yield('scripts')
</html>
