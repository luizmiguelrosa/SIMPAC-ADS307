@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Modelo Avaliativo</h1>

    <form action="{{ route('evaluative_models.update', $evaluativeModel->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="model_name">Modelo Avaliativo</label>
            <input type="text" class="form-control" id="model_name" name="model_name" value="{{ $evaluativeModel->model_name }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary mt-3">Salvar</button>
    </form>
</div>
@endsection
