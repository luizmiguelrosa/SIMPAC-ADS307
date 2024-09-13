@extends('layouts.app')

@section('content')
<div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
   
            <header >
                

              <!--  @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        @auth
                            @if (Route::middleware(['auth', 'user-access:admin']))
                                <a href="{{ route('admin.home') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Painel de Administrador
                                </a>
                            @endif
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif -->
            </header>

            <!-- Novo conteúdo -->
            <main>
                <div class="spacer"></div> <!-- Espaço acima dos botões -->
                <div class="container">
                    <!-- Comentando a parte da edição por enquanto -->
                    
                    <div class="edicao">
                        <div class="position-relative">
                            <img src="/assets/balao.svg" alt="Edição atual do SIMPAC" class="img-fluid">
                            <span class="numero-edicao position-absolute top-50 start-50 translate-middle">
                              XXV <!-- Aqui você pode passar a variável da edição atual -->
                            </span>
                        </div>
                    </div>
                    
                    <!-- Logo-simpac SIMAPC -->
                    <div class="logo-simpac">
                        <img src="/assets/logo-simpac.svg" alt="Logo SIMPAC" class="img-fluid" />
                    </div>
                </div>
            </main>

            <div class="content">
                <div>
                    <br>
                    @auth
                        <a href="{{ route('admin.home') }}" class="btn btn-primary btn-custom d-block mx-auto fw-bold">ADMIN</a>
                        <br>
                        <a href="{{ route('home') }}" class="btn btn-primary btn-custom d-block mx-auto fw-bold">AVALIADOR</a>
                        <br>
                        <a href="{{ route('home') }}" class="btn btn-primary btn-custom d-block mx-auto fw-bold">RESUMOS APROVADOS</a>
                        <br>
                    @else
                        <p class="text-center">Por favor, <a href="{{ route('login') }}" class="text-blue-500">faça login</a> para acessar essas páginas.</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
<style>
        .container {
            text-align: center;
        }
        .logo-simpac img {
            max-width: 300px;
            height: auto;
        }
        .btn {
            margin: 10px;
            width: 200px;
        }
        .spacer {
            height: 15vh;
        }
        .numero-edicao {
            font-size: 24px;
            color: white;
            font-family: "Abril Fatface", serif;
            font-weight: 600;
        }
        .btn.btn-custom {
            background-color: #205483 !important;
            border-color: #000000 !important;
        }
        .btn.btn-custom:hover {
            background-color: #2C2D48 !important;
            border-color: #00AFEF !important;
        }
        @media (max-width: 576px) {
            .logo-simpac img {
                max-width: 150px;
            }
            .btn {
                width: 50%;
            }
            .edicao img {
                height: auto;
                max-width: 20%;
            }
            .numero-edicao {
                font-size: 14px;
            }
        }
    </style>
@endsection
