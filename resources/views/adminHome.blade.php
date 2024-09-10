@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Você é um Usuário Administrador.</h2>

                    <div class="contador-simposio mt-4">
                        <!-- Formulário para Iniciar Simpósio -->
                        <form action="{{ route('symposium.start') }}" method="GET" class="d-block mx-auto">
                            <button type="submit" class="btn btn-primary btn-custom fw-bold">INICIAR SIMPÓSIO</button>
                        </form>

                        <!-- Botão para Finalizar Simpósio (Futura Implementação) -->
                         <form action="{{ route('symposium.end') }}" method="GET"  class="d-block mx-auto">
                            <button type="submit" class="btn btn-primary btn-custom d-block mx-auto fw-bold">FINALIZAR SIMPÓSIO</button>
                         </form>
                    </div>

                    <a href="{{ route('admin.create-work') }}" class="btn btn-primary btn-custom d-block mx-auto mt-3 fw-bold">NOVO TRABALHO</a>
                    <a href="#" class="btn btn-primary btn-custom d-block mx-auto mt-3 fw-bold">ALTERAR TRABALHO</a>
                    <a href="#" class="btn btn-primary btn-custom d-block mx-auto mt-3 fw-bold">RESULTADOS</a>
                    <a href="#" class="btn btn-primary btn-custom d-block mx-auto mt-3 fw-bold">AVALIADORES CADASTRADOS</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn {
        margin: 2%;
        width: 200px;
    }

    .btn.btn-custom {
        background-color: #205483 !important; /* Cor de fundo dos botões */
        border-color: #000000 !important;
    }

    .btn.btn-custom:hover {
        background-color: #2C2D48 !important;
        border-color: #00AFEF !important;
    }

    .contador-simposio {
        display: flex;
        justify-content: space-between;
        gap: 2rem; /* Espaço entre os botões */
    }

    @media (max-width: 576px) {
        .contador-simposio {
            flex-direction: column; /* Alterar direção para coluna em dispositivos móveis */
            width: 100%; /* Botões ocupam toda a largura disponível */
            font-size: 0.875rem; /* Tamanho da fonte menor para dispositivos móveis */
        }
    }
</style>
@endsection
