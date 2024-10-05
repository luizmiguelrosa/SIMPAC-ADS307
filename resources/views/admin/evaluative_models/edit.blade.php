@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Editar Modelo Avaliativo</h1>

    <form action="{{ route('evaluative_models.update', $evaluativeModel->id) }}" method="POST" id="evaluative-model-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="model_name">Modelo Avaliativo</label>
            <input type="text" class="form-control" id="model_name" name="model_name" value="{{ $evaluativeModel->model_name }}" required>
        </div>

        

        <a href="{{ route('evaluative_models.index') }}" class="btn btn-custom-red mt-3">Cancelar</a>
        <button type="submit" class="btn btn-custom mt-3">Salvar</button> <!-- tá enviando pra onde ?-->
    </form>
</div>


@endsection
