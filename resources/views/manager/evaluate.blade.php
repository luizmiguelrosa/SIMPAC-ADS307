@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Avaliar Trabalho: {{ $work->protocol }}</h1>

    <form action="{{ route('manager.works.storeEvaluation', $work->id) }}" method="POST">
        @csrf
        @foreach ($work->evaluative_model->questions as $question) <!-- Supondo que você tenha perguntas relacionadas -->
            <div class="form-group">
                <label>{{ $question->text }}</label>
                <input type="number" name="responses[{{ $question->id }}]" class="form-control" required>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Enviar Avaliação</button>
    </form>
</div>
@endsection
