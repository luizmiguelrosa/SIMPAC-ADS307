@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Resultados das Avaliações</h1>

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.results.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="course">Curso:</label>
                <input type="text" name="course" id="course" class="form-control" value="{{ request('course') }}">
            </div>
            
            <div class="col-md-4">
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
            <div class="col-md-4">
                <label for="category">Categoria:</label>
                <select name="category" id="category" class="form-control">
                    <option value="">Selecione...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
    </form>

    <!-- Tabela de Resultados -->
    @if($works->isEmpty())
        <p>Nenhum resultado encontrado.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Protocolo</th>
                    <th>Curso</th>
                    <th>Modelo Avaliativo</th>
                    <th>Categoria</th>
                    <th>Nota Média</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($works as $work)
                    <tr>
                        <td>{{ $work->protocol }}</td>
                        <td>{{ $work->course->course_abbreviation ?? 'N/A' }}</td>
                        <td>{{ $work->evaluative_model->model_name ?? 'N/A' }}</td>
                        <td>{{ $work->category->category_name ?? 'N/A' }}</td>
                        <td>{{ $work->average_score ? number_format($work->average_score, 2) : 'Sem Avaliação' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
