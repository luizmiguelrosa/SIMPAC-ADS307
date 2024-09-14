<!-- resources/views/evaluators/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Avaliadores</h1>
    <a href="{{ route('evaluators.create') }}" class="btn btn-primary mb-3">Adicionar Avaliador</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evaluators as $evaluator)
                <tr>
                    <td>{{ $evaluator->name }}</td>
                    <td>{{ $evaluator->email }}</td>
                    <td>
                        <a href="{{ route('evaluators.edit', $evaluator->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('evaluators.destroy', $evaluator->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este avaliador?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
