<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <header>
            @if (Auth::check() && Auth::user()->hasRole('admin'))
                @include('navbar.admin')
            @elseif (Auth::check() && Auth::user()->hasRole('manager'))
                @include('navbar.manager')
            @endif
        </header>

        <main class="py-4 mt-5">
            @if (session('status'))
                <div id="alert-box" class="alert alert-{{ session('status') }} position-fixed top-1 end-0 mt-3 me-3 z-1" role="alert">
                    {{ session('message') }}

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            setTimeout(function () {
                                var alertBox = document.getElementById('alert-box');
                                if (alertBox) {
                                    alertBox.remove();
                                }
                            }, 5000);
                        });
                    </script>
                </div>
            @endif
            @yield('content')
        </main>
        @include('layouts.footer') <!-- Inclui o footer -->
    </div>

    <!-- Custom CSS for Navbar -->
    <style>
        .navbar-toggler.custom-toggler {
            background-color: #205483; /* Azul */
            border-color: #205483;
        }

        .navbar-toggler.custom-toggler .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        .navbar-toggler-icon {
            width: 1.5em;
            height: 1.5em;
        }
        html, body {
    height: 100%;
    margin: 0;
}
/* CSS para footer ficar ao final do conteudo */
#app {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

main {
    flex: 1; /* O conteúdo principal se expande para ocupar o espaço disponível */
}

footer {
    background-color: #f8f9fa;
    padding: 20px;
    text-align: center;
    position: relative;
    bottom: 0;
    width: 100%;
}

    </style>
</body>
</html>
