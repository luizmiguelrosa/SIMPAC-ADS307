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
    </form>

    <!-- Tabela de Resultados -->
    @if($works->isEmpty())
        <p>Nenhum resultado encontrado.</p>
    @else
        @foreach ($works->groupBy('evaluative_model.model_name') as $modelName => $groupedWorks)
            <h3 class="text-center">{{ $modelName }}</h3>
            <table class="table table-striped table-responsive-sm">
                <thead>
                <tr class="text-center">
                        <th>Ranking</th>
                        <th>Protocolo</th>
                        <th>Curso</th>
                        <th>Nota Média</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($groupedWorks->sortByDesc('average_score')->values() as $index => $work)
                    <tr class="text-center">
                        <td>
                            @if($index == 0)
                            <img src="/assets/ranking/icons8-1st-place-medal-emoji-32.png" alt="1º Lugar">
                            @elseif($index == 1)
                            <img src="/assets/ranking/icons8-2nd-place-medal-emoji-32.png" alt="2º Lugar">
                            @elseif($index == 2)
                            <img src="/assets/ranking/icons8-3rd-place-medal-emoji-32.png" alt="3º Lugar">
                            @else
                            {{ $index + 1 }}º
                            @endif
                        </td>
                        <td>{{ $work->protocol }}</td>
                        <td>{{ $work->course->course_abbreviation ?? 'N/A' }}</td>
                        <td>{{ $work->average_score ? number_format($work->average_score, 2) : 'Sem Avaliação' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
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

</style>
@endsection
