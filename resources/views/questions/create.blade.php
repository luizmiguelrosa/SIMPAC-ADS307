@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Adicionar Perguntas ao Modelo Avaliativo: {{ $evaluativeModel->model_name }}</h1>

    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <input type="hidden" name="evaluative_model_id" value="{{ $evaluativeModel->id }}">

        <div id="questions-container">
            <h3>Perguntas</h3>
            @for($i = 1; $i <= 5; $i++) <!-- Altere a quantidade de perguntas conforme necessário -->
                <div class="form-group mb-3">
                    <label for="question_{{ $i }}">Pergunta {{ $i }}</label>
                    <input type="text" class="form-control" id="question_{{ $i }}" name="questions[]" placeholder="Pergunta {{ $i }}">
                </div>
            @endfor
        </div>

        <button type="submit" class="btn btn-success mt-3">Salvar Perguntas</button>
    </form>
</div>
@endsection
