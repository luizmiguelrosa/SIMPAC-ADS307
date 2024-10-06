@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Lista de Trabalhos Criados</h1>
    
    <!-- Botão para criar um novo trabalho -->
    <div class="text-center mt-4">
        <a href="{{ route('admin.create-work') }}" class="btn btn-custom">Criar Novo Trabalho</a>
    </div>
    <!-- Filtros -->
    <form method="GET" action="{{ route('works.index') }}" class="mb-4">
        <div class="row">
            <!-- Filtro por Curso -->
            <div class="col-md-4">
                <label for="course">Curso:</label>
                <input type="text" name="course" id="course" class="form-control" value="{{ request('course') }}">
            </div>
            
            <!-- Filtro por Modelo Avaliativo -->
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

            <!-- Filtro por Categoria -->
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
        <button type="submit" class="btn btn-custom mt-3">Filtrar</button>
    </form>

    <!-- Tabela de Trabalhos -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Protocolo</th>
                <th>Resumo</th>
                <th>Curso</th>
                <th>Categoria</th>
                <th>Modelo Avaliativo</th>
                <th>Avaliadores</th>
                <th>Ações</th>
                <th>Edição Simpósio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($works as $work)
                <tr>
                    <td>{{ $work->protocol }}</td>
                    <td>{{ $work->overview }}</td>
                    <td>{{ $work->course->course_name }}</td>
                    <td>{{ $work->category->category_name }}</td>
                    <td>{{ $work->evaluative_model->model_name }}</td>
                    <td>
                    <!-- Exibindo os avaliadores associados ao trabalho -->
                    @foreach($work->evaluators as $evaluator)
                        <span class="badge bg-primary">{{ $evaluator->name }}</span>
                    @endforeach
                </td>
                    <td>
                        <!-- Botão de Editar -->
                        <a href="{{ route('admin.edit-work', $work->id) }}" class="btn btn-sm btn-warning">
                            Editar
                        </a>
                        <!-- Formulário para Deletar -->
                        <form action="{{ route('admin.delete-work', $work->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Você tem certeza que deseja deletar este trabalho?');">
                                Deletar
                            </button>
                        </form>
                    </td>
                    <td>{{ $work->symposium->edition }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
