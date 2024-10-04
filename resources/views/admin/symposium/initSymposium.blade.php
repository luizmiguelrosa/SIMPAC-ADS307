@extends('layouts.app')

@vite(['resources/js/index.js'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('symposium.start') }}" method="POST">
                            @csrf

                            <div class="d-flex flex-column form-group mb-3">
                                <label for="edition">Número da Edição</label>
                                <input type="text" name="edition" required>
                            </div>

                            <div class="d-flex flex-column form-group mb-3">
                                <label for="password">Senha de Administrador</label>
                                <input type="password" name="password" required>
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" name="confirm_checkbox" class="form-check-input" required>
                                <label for="confirm_checkbox" class="form-check-label">Eu li e entendo que, ao clicar em 'Iniciar o Simpósio', sou responsável por gerenciar o evento, garantir o cumprimento de todas as diretrizes e procedimentos necessários, bem como pela proteção da informação e integridade do simpósio contra qualquer dano.</label>
                            </div>

                            <div class="btn-container d-flex justify-content-evenly">
                                <a href="{{ route('admin.home') }}" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-custom">Iniciar Simpósio</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection