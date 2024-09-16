<!-- resources/views/evaluators/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Avaliador</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evaluators.update', $evaluator->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $evaluator->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $evaluator->email) }}" required>
        </div>

        <div class="form-group">
            <label for="password">Senha (deixe em branco para não alterar)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Senha</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
</div>
@endsection
