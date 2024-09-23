<!-- resources/views/admin/works/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Lista de Trabalhos Criados</h1>

    <!-- Tabela de Trabalhos -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Protocolo</th>
                <th>Resumo</th>
                <th>Curso</th>
                <th>Categoria</th>
                <th>Modelo Avaliativo</th>
                <th>Ações</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Botão para criar um novo trabalho -->
    <div class="text-center mt-4">
        <a href="{{ route('admin.create-work') }}" class="btn btn-primary">Criar Novo Trabalho</a>
    </div>
</div>
@endsection
