@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Criar Avaliador</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evaluators.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        
        <div class="btn-container justify-content">
            <a href="{{ route('evaluators.index') }}" class="btn btn-custom-red mt-3">Cancelar</a>
            <button type="submit" class="btn btn-custom mt-3">Salvar</button>
        </div>
    </form>
</div>
@endsection
