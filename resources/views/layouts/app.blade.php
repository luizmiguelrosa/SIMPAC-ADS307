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
            <nav class="navbar bg-body-tertiary fixed-top">
                <div class="container-fluid">
                    <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="d-flex flex-grow-1 justify-content-center">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="/assets/univicosa_horizontal.LOGO.png" alt="Logo da Univicosa" class="img-fluid" style="max-width: 200px; width: 100%; height: auto;">
                        </a>
                    </div>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Resultados</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Trabalhos
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Cadastrar</a></li>
                                        <li><a class="dropdown-item" href="#">Visualizar</a></li>
                                        <li><a class="dropdown-item" href="#">Atualizar</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Apagar</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Avaliadores
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Cadastrar</a></li>
                                        <li><a class="dropdown-item" href="#">Visualizar</a></li>
                                        <li><a class="dropdown-item" href="#">Atualizar</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Apagar</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Configurações Internas
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Perguntas</a></li>
                                        <li><a class="dropdown-item" href="#">Modelo Avaliativo</a></li>
                                        <li><a class="dropdown-item" href="#">Cursos</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Sair
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main class="py-4 mt-5">
            @if (session('status'))
                <div class="alert alert-{{ session('status') }} position-fixed top-1 end-0 mt-3 me-3" role="alert">
                    {{ session('message') }}
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
    </style>
</body>
</html>
