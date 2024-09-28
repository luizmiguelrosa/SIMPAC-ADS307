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
                    <!-- Botão para Todos os Cursos -->
                    <button type="submit" name="course" value="" class="btn btn-secondary m-2">
                        Todos os Cursos
                    </button>
                    
                    @foreach($courses as $course)
                        <button type="submit" name="course" value="{{ $course->course_abbreviation }}" class="btn btn-primary m-2">
                            {{ $course->course_abbreviation }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="col-md-6 mt-3">
                <label for="evaluative_model">Modelo Avaliativo:</label>
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
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('admin.results.index') }}" class="btn btn-secondary">Limpar Filtros</a>
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
@endsection
