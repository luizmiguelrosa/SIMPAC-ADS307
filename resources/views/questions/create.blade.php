@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Associar Perguntas ao Modelo Avaliativo</h1>

    <!-- Exibe mensagens de sucesso -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulário para selecionar o modelo avaliativo -->
    <form method="GET" action="{{ route('questions.create') }}">
        <div class="form-group mb-3">
            <label for="evaluative_model_id">Modelo Avaliativo</label>
            <select class="form-control" id="evaluative_model_id" name="evaluative_model_id" required>
                <option value="">Selecione um modelo avaliativo</option>
                @foreach($evaluativeModels as $model)
                    <option value="{{ $model->id }}">{{ $model->model_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Pergunta quantas perguntas o usuário deseja inserir -->
        <div class="form-group mb-3">
            <label for="num_questions">Quantas perguntas você quer inserir?</label>
            <input type="number" class="form-control" id="num_questions" name="num_questions" value="{{ old('num_questions', $numQuestions) }}" min="1" max="20" required>
        </div>

        <button type="submit" class="btn btn-custom">Gerar Perguntas</button>
    </form>

    <!-- Formulário dinâmico de perguntas, exibido após a seleção -->
    @if($numQuestions > 0)
    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <input type="hidden" name="evaluative_model_id" value="{{ request('evaluative_model_id') }}">

        <div id="questions-container">
            <h3>Perguntas</h3>
            @for($i = 1; $i <= $numQuestions; $i++)
                <div class="form-group mb-3">
                    <label for="question_{{ $i }}">Pergunta {{ $i }}</label>
                    <input type="text" class="form-control @error('questions.' . ($i - 1)) is-invalid @enderror" id="question_{{ $i }}" name="questions[]" placeholder="Pergunta {{ $i }}">
                    @error('questions.' . ($i - 1))
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endfor
        </div>

        <button type="submit" class="btn btn-success mt-3">Salvar Perguntas</button>
    </form>
    @endif
</div>
@endsection
