@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Editar Categoria</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="category_name">Nome da Categoria</label>
            <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ old('category_name', $category->category_name) }}" required>
            @error('category_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <a href="{{ route('categories.index') }}" class="btn btn-custom-red mt-3">Cancelar</a>
        <button type="submit" class="btn btn-custom mt-3">Atualizar</button>
    </form>
</div>
@endsection
