@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="login-container">
        <h3 class="mb-4 custom-heading">BOAS-VINDAS</h3>
        <p class="mb-4 custom-heading">INSIRA SUAS CREDENCIAIS</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label"><strong>Email</strong></label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Seu email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label"><strong>Senha</strong></label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Sua senha" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="form-text text-end">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Esqueci a senha?</a>
                    @endif
                </div>
            </div>

            <div class="btn-container mt-4">
                <a href="/home.html" class="btn btn-primary btn-custom fw-bold">VOLTAR</a>
                <button type="submit" class="btn btn-primary btn-custom fw-bold">ENTRAR</button>
            </div>
        </form>
    </div>
</div>


<style>
    .btn.btn-custom {
        background-color: #205483 !important; /* Cor de fundo dos botões */
        border-color: #000000 !important;
    }

    .btn.btn-custom:hover {
        background-color: #2C2D48 !important;
        border-color: #00AFEF !important;
    }

    .login-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 2rem;
    }

    .btn-custom {
        padding: 0.9rem 2rem;
    }

    .btn-container {
        display: flex;
        justify-content: space-between;
        gap: 1rem; /* Espaço entre os botões */
    }

    .custom-heading {
        font-weight: 700;
        color: #00AFEF;
        text-align: center;
    }

    @media (max-width: 576px) {
        .btn-container .btn {
            width: 100%; /* Botões ocupam toda a largura disponível */
            font-size: 0.875rem; /* Tamanho da fonte menor para dispositivos móveis */
        }
    }
</style>
@endsection
