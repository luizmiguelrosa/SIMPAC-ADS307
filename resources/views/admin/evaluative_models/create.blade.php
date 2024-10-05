@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Criar Novo Modelo Avaliativo</h1>

    <!-- Formulário apenas para criação do modelo avaliativo -->
    <form action="{{ route('evaluative_models.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="model_name">Nome do Modelo Avaliativo</label>
            <input type="text" class="form-control" id="model_name" name="model_name" required placeholder="Digite o nome do modelo avaliativo">
        </div>


        <div class="btn-container justify-content text-center">
            <a href="{{ route('evaluative_models.index') }}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-custom">Criar Modelo</button>
        </div>
    </form>
</div>
@endsection
