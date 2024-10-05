@extends('layouts.app')

@section('content')
<div class="container text-center"> <!-- Centraliza o conteúdo -->
    <h1 class="mb-4">Visualizar Perguntas</h1>

    <!-- Formulário para selecionar o modelo avaliativo -->
    <form method="GET" action="{{ route('questions.index') }}" class="mb-5">
        <div class="form-group mb-3">
            <label for="evaluative_model_id" class="h5">Modelo Avaliativo</label>
            <select class="form-control text-center" id="evaluative_model_id" name="evaluative_model_id" required>
                <option value="">Selecione um modelo avaliativo</option>
                @foreach($evaluativeModels as $model)
                    <option value="{{ $model->id }}" {{ $selectedModelId == $model->id ? 'selected' : '' }}>
                        {{ $model->model_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <a href="{{ route('evaluative_models.index') }}" class="btn btn-secondary">Voltar</a> <!-- Botão de voltar para a listagem dos modelos -->
        <button type="submit" class="btn btn-custom">Ver Perguntas</button>
    </form>

    <!-- Exibe as perguntas associadas ao modelo selecionado -->
    @if(!empty($questions))
        <h3 class="mb-3">Perguntas Associadas</h3>
        @if($questions->count() > 0)
            <ul class="list-group mb-4">
                @foreach($questions as $question)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $question->question_text }}
                        <div>
                            <!-- Botão de editar -->
                            <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning btn-sm me-2">Editar</a>

                            <!-- Formulário para excluir pergunta -->
                            <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta pergunta?')">Excluir</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">Não há perguntas associadas a este modelo avaliativo.</p>
        @endif
    @endif

    <!-- Botão para adicionar uma nova pergunta -->
    <button class="btn btn-custom mt-4" data-bs-toggle="collapse" data-bs-target="#add-question-form">
        Associar Nova Pergunta
    </button>

    <!-- Formulário para adicionar novas perguntas -->
    <div id="add-question-form" class="collapse mt-4 text-start">
        <h3 class="mb-3">Adicionar Nova Pergunta</h3>
        <form action="{{ route('questions.store') }}" method="POST">
            @csrf
            <input type="hidden" name="evaluative_model_id" value="{{ $selectedModelId }}">

            <div class="form-group mb-3">
                <label for="question_text">Texto da Pergunta</label>
                <input type="text" class="form-control @error('question_text') is-invalid @enderror" id="question_text" name="question_text" required>
                @error('question_text')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class=" justify-content text-center">
                <button type="button" class="btn btn-custom-red" data-bs-toggle="collapse" data-bs-target="#add-question-form">Cancelar</button> <!-- Botão de cancelar -->
                <button type="submit" class="btn btn-custom">Adicionar Pergunta</button>
            </div>
        </form>
    </div>
</div>
@endsection
