<!-- resources/views/create-work.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="col-md-8">
        <h1 class="text-center mb-4">Criar Novo Trabalho</h1>

        <!-- Mensagem de sucesso -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulário -->
        <form action="{{ route('admin.store-work') }}" method="POST">
            @csrf

            <!-- Campo de protocolo -->
            <div class="form-group mb-3">
                <label for="protocol">Protocolo</label>
                <input type="text" class="form-control @error('protocol') is-invalid @enderror" id="protocol" name="protocol" value="{{ old('protocol') }}" required>
                @error('protocol')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Campo de seleção de curso -->
            <div class="form-group mb-3">
                <label for="course_id">Curso</label>
                <select class="form-control @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                    <option value="">Selecionar curso</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                    @endforeach
                </select>
                @error('course_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Campo de seleção de avaliadores com multiselect aprimorado -->
<div class="form-group mb-3">
    <label for="evaluatorsDropdown" class="form-label">Avaliadores</label>
    <button class="btn btn-secondary dropdown-toggle w-100 py-2" type="button" id="evaluatorsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        Selecionar Avaliadores
    </button>
    
    <div class="dropdown-menu w-100 p-3 shadow-lg" aria-labelledby="evaluatorsDropdown" style="max-height: 300px; overflow-y: auto;">
        <!-- Campo de busca dentro do dropdown -->
        <input type="text" class="form-control mb-3" id="searchEvaluator" placeholder="Buscar avaliador..." onkeyup="filterEvaluators()">
        
        @foreach($evaluators as $evaluator)
            <div class="form-check evaluator-item">
                <input class="form-check-input" type="checkbox" name="evaluators[]" value="{{ $evaluator->id }}" id="evaluator{{ $evaluator->id }}">
                <label class="form-check-label" for="evaluator{{ $evaluator->id }}">
                    {{ $evaluator->name }}
                </label>
            </div>
        @endforeach
    </div>

    @error('evaluators')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>

            <!-- Botões de cancelar e enviar -->
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-danger" onclick="window.location.replace('{{ route('admin.home')}}'); return false;">Cancelar</button>
                <button type="submit" class="btn btn-primary">Create Work</button>

            </div>
        </form>
    </div>
</div>
@endsection

<script>
    // parte de js
    // Manter o dropdown aberto após selecionar um avaliador
    document.querySelectorAll('.dropdown-menu input[type="checkbox"]').forEach(function(checkbox) {
        checkbox.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
    // Função para filtrar avaliadores na lista
function filterEvaluators() {
    var input, filter, items, i, txtValue;
    input = document.getElementById('searchEvaluator');
    filter = input.value.toLowerCase();
    items = document.getElementsByClassName('evaluator-item');
    
    for (i = 0; i < items.length; i++) {
        txtValue = items[i].textContent || items[i].innerText;
        if (txtValue.toLowerCase().indexOf(filter) > -1) {
            items[i].style.display = "";
        } else {
            items[i].style.display = "none";
        }
    }
}

</script>
<style>
    /* Ajustando o botão e o dropdown */
#evaluatorsDropdown {
    font-size: 1.1rem;
    font-weight: 500;
    background-color: #205483; /* Azul padrão */
    color: white;
    border-radius: 8px;
    padding: 12px;
}

.dropdown-menu {
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.form-check-input {
    transform: scale(1.2);
    margin-right: 10px;
}

.form-check-label {
    font-size: 1rem;
}

/* Campo de busca */
#searchEvaluator {
    font-size: 1rem;
    border-radius: 8px;
    padding: 8px 12px;
    border: 1px solid #ccc;
}

.evaluator-item {
    padding: 8px 0;
}

/* Efeitos ao passar o mouse */
.dropdown-menu .form-check:hover {
    background-color: #f1f1f1;
    border-radius: 5px;
}

/* Aumenta o espaço entre os elementos */
.form-group {
    margin-bottom: 1.5rem;
}

</style>