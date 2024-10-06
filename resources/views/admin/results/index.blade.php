@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Resultados das Avaliações</h1>

    <!-- Filtros por curso -->
    <form method="GET" action="{{ route('admin.results.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-12 text-center">
                <label class="form-label"><strong>Cursos</strong></label>
                <div class="d-flex flex-wrap justify-content-center">
                    @foreach($courses as $course)
                    <button type="submit" name="course" value="{{ $course->course_abbreviation }}" class="btn btn-custom m-2">
                        {{ $course->course_abbreviation }}
                    </button>
                    @endforeach
                    <!-- Botão para Todos os Cursos -->
                    <button type="submit" name="course" value="" class="btn btn-secondary m-2">
                        Todos os Cursos
                    </button>
                </div>
            </div>

            <!-- Filtros por MODELO AVALIATIVO -->
            <div class="col-md-12 mt-3 text-center">
                <label for="evaluative_model"><strong> Modelo Avaliativo:</strong></label>
                <div class="d-flex justify-content-center">
                    <div class="mt-3" style="width: 250px;">
                        <select name="evaluative_model" id="evaluative_model" class="form-control">
                            <option value="">Selecione...</option>
                            @foreach($evaluativeModels as $model)
                                <option value="{{ $model->id }}" {{ request('evaluative_model') == $model->id ? 'selected' : '' }}>
                                    {{ $model->model_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="mt-3 text-center">
                    <a href="{{ route('admin.results.index') }}" class="btn btn-secondary">Limpar Filtros</a>
                    <button type="submit" class="btn btn-custom">Filtrar</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Cards de Resultados -->
    @if($works->isEmpty())
        <p>Nenhum resultado encontrado.</p>
    @else
        <div class="row">
            @foreach ($works->groupBy('evaluative_model.model_name') as $modelName => $groupedWorks)
                <h2 class="text-center" style="background-color: #242025; color: white; padding: 10px;">{{ $modelName }}</h2>
                @foreach ($groupedWorks->sortByDesc('average_score')->values() as $index => $work)
                    <!--<div class="col-md-6 col-lg-4 mb-4"> Aqui mantem dois cards ou mais na mesma linha-->
                    <div class="col-12 mb-4"> <!-- Mantendo apenas um card por coluna no desktop col-12 -->
                        <a href="{{ route('admin.results.show', ['id' => $work->id]) }}" class="text-decoration-none"> <!--Deixa o card clicavel-->
                            <div class="card shadow-sm">
                                <div class="card-body text-center">
                                    <div>
                                        @if($index == 0)
                                        <img src="/assets/ranking/icons8-1st-place-medal-emoji-32.png" alt="1º Lugar">
                                        @elseif($index == 1)
                                        <img src="/assets/ranking/icons8-2nd-place-medal-emoji-32.png" alt="2º Lugar">
                                        @elseif($index == 2)
                                        <img src="/assets/ranking/icons8-3rd-place-medal-emoji-32.png" alt="3º Lugar">
                                        @else
                                        <span>{{ $index + 1 }}º</span>
                                        @endif
                                    </div>
                                    <h5 class="card-title">{{ $work->overview }}</h5>
                                    <p class="text-muted small">Protocolo: {{ $work->protocol }} | Curso: {{ $work->course->course_name }}</p>
                                    <p class="fw-bold">Nota: {{ $work->average_score ? number_format($work->average_score, 2) : 'Sem Avaliação' }}</p>
                                </div>
                            </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    @endif
</div>

<style>
    .btn-custom {
        background-color: #205483; /* Um azul mais escuro */
        color: white; /* Cor do texto */
    }

    .btn-custom:hover {
        background-color: #00afef;
        color: white;
    }

    /* Estilo dos cards */
    .card {
        border-radius: 8px;
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection
