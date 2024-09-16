@extends('layouts.app')

@vite(['resources/js/index.js'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('symposium.end') }}" method="POST">
                            @csrf

                            <div class="d-flex flex-column form-group mb-3">
                                <label for="password">Senha de Administrador</label>
                                <input type="password" name="password" required>
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" name="confirm_checkbox" class="form-check-input" required>
                                <label for="confirm_checkbox" class="form-check-label">Eu li e entendo que, ao clicar em 'Finalizar o Simpósio', confirmo que todas as atividades foram concluídas, e aceito a responsabilidade pela integridade dos dados gerados durante o evento e pela preservação das informações até seu arquivamento final.</label>
                            </div>

                            <div class="form-group d-flex justify-content-evenly ">
                                <button class="btn btn-danger" onclick="window.location.replace('{{ route('admin.home') }}'); return false;">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Finalizar Simpósio</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection