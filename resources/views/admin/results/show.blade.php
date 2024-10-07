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
            <!-- Exibindo os avaliadores associados ao trabalho -->
            <p><strong>Avaliadores:</strong></p>
                @foreach($work->evaluators as $evaluator)
                    <a href="{{ route('admin.results.evaluatorEvaluation', ['workId' => $work->id, 'evaluatorId' => $evaluator->id]) }}">
                        <span class="badge bg-primary">{{ $evaluator->name }}</span>
                    </a>
                @endforeach


        </div>
    </div>
  <!--  <h3>Detalhes do Avaliador: {{ $evaluator->name }}</h3>  quero apagar essa linha, mas preciso entender pq aqui consigo ler pelo menos um nome do avaliador e na outra página não
<p><strong>Email:</strong> {{ $evaluator->email }}</p>

<h4>Avaliações realizadas</h4>

@if($evaluator->evaluations->isEmpty())
    <p>Este avaliador ainda não realizou nenhuma avaliação.</p>
@else
    <ul>
        @foreach($evaluator->evaluations as $evaluation)
            <li>
                <strong>Trabalho Avaliado:</strong> {{ $evaluation->work->title }} <br>
                <strong>Respostas:</strong>
                <ul>
                    @php
                        // Decodifica o JSON de respostas
                        $responses = json_decode($evaluation->responses, true);
                    @endphp

                    @foreach($responses as $question => $score)
                        <li><strong>Pergunta {{ $question }}:</strong> Nota {{ $score }}</li>
                    @endforeach
                </ul>
                <hr>
            </li>
        @endforeach
    </ul>
@endif -->

    <a href="{{ route('admin.results.index') }}" class="btn btn-secondary">Voltar</a> <!-- Botão de voltar para a listagem dos modelos -->
</div>
@endsection
