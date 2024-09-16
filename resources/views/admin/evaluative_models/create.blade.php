@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Novo Modelo Avaliativo</h1>

    <form action="{{ route('evaluative_models.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="model_name">Modelo Avaliativo</label>
            <input type="text" class="form-control" id="model_name" name="model_name" required>
        </div>
        
        <button type="submit" class="btn btn-primary mt-3">Criar</button>
    </form>
</div>
@endsection
