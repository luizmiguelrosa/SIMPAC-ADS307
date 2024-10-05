@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Criar Categoria</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="category_name">Nome da Categoria</label>
            <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ old('category_name') }}" required>
            @error('category_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="btn-container justify-content">
            <a href="{{ route('categories.index') }}" class="btn btn-custom-red">Cancelar</a>
            <button type="submit" class="btn btn-custom">Adicionar</button>
        </div>
    </form>
</div>
@endsection
