@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Pergunta</h1>

    <form action="{{ route('questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="question_text">Texto da Pergunta</label>
            <input type="text" class="form-control @error('question_text') is-invalid @enderror" id="question_text" name="question_text" value="{{ old('question_text', $question->question_text) }}" required>
            @error('question_text')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ route('questions.index', ['evaluative_model_id' => $question->evaluative_model_id]) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
