@extends('layouts.app')

@section('content')
<div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
    <header>
        <!-- Header pode ser configurado aqui, se necessário -->
    </header>

    <!-- Novo conteúdo -->
    <main>
        <div class="spacer"></div> <!-- Espaço acima dos botões -->
        <div class="container">
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
                <a href="{{ route('login') }}" class="btn btn-primary btn-custom d-block mx-auto fw-bold">ADMIN</a>
                <br>
                <a href="{{ route('login') }}" class="btn btn-primary btn-custom d-block mx-auto fw-bold">AVALIADOR</a>
                <br>
                <a href="{{ route('login') }}" class="btn btn-primary btn-custom d-block mx-auto fw-bold">RESUMOS APROVADOS</a>
                <br>
            @endauth
        </div>
    </div>
</div>
@endsection

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
