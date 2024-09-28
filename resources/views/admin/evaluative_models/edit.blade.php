@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Modelo Avaliativo</h1>

    <form action="{{ route('evaluative_models.update', $evaluativeModel->id) }}" method="POST" id="evaluative-model-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="model_name">Modelo Avaliativo</label>
            <input type="text" class="form-control" id="model_name" name="model_name" value="{{ $evaluativeModel->model_name }}" required>
        </div>

        <div id="questions-container">
            <h3>Perguntas</h3>
            <!-- Renderiza perguntas existentes -->
            @foreach($evaluativeModel->questions as $index => $question)
                <div class="form-group question-group">
                    <label for="question_{{ $index }}">Pergunta {{ $index + 1 }}</label>
                    <input type="text" class="form-control" id="question_{{ $index }}" name="questions[]" value="{{ $question->question_text }}" required>
                    <button type="button" class="btn btn-danger mt-2 remove-question">Remover</button>
                </div>
            @endforeach
        </div>

       <!-- <button type="button" class="btn btn-secondary mt-3" id="add-question">Adicionar Pergunta</button> Por hora não funciona -->
        <button type="submit" class="btn btn-custom mt-3">Salvar</button> <!-- tá enviando pra onde ?-->
    </form>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let questionCount = 0;

    document.getElementById('add-question').addEventListener('click', function() {
        questionCount++;
        const container = document.getElementById('questions-container');
        const div = document.createElement('div');
        div.className = 'form-group question-group';
        div.innerHTML = `
            <label for="question_${questionCount}">Pergunta ${questionCount}</label>
            <input type="text" class="form-control" id="question_${questionCount}" name="questions[]" required>
            <button type="button" class="btn btn-danger mt-2 remove-question">Remover</button>
        `;
        container.appendChild(div);
    });

    // Event delegation to handle removing questions
    document.getElementById('questions-container').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-question')) {
            e.target.parentElement.remove();
        }
    });
});
</script>
@endsection

@endsection
