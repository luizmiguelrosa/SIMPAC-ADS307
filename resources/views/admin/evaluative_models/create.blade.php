@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Novo Modelo Avaliativo</h1>

    <!-- Formulário apenas para criação do modelo avaliativo -->
    <form action="{{ route('evaluative_models.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="model_name">Nome do Modelo Avaliativo</label>
            <input type="text" class="form-control" id="model_name" name="model_name" required placeholder="Digite o nome do modelo avaliativo">
        </div>

        <button type="submit" class="btn btn-custom mt-3">Criar Modelo</button>
    </form>
</div>
@endsection
