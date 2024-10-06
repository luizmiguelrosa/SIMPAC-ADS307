@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Trabalho</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h2>{{ $work->overview }}</h2>
            <p><strong>Protocolo:</strong> {{ $work->protocol }}</p>
            <p><strong>Curso:</strong> {{ $work->course->course_name }}</p>
            <p><strong>Modelo Avaliativo:</strong> {{ $work->evaluative_model->model_name }}</p>
            <p><strong>Nota Média:</strong> {{ $work->average_score ? number_format($work->average_score, 2) : 'Sem Avaliação' }}</p>
        </div>
    </div>
    <a href="{{ route('admin.results.index') }}" class="btn btn-secondary">Voltar</a> <!-- Botão de voltar para a listagem dos modelos -->
</div>
@endsection
