@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Avaliações do Avaliador:</h1> <!--não consegui chamar a variavel $evaluator->name (já sei q ela é o user mas mesmo assim.)-->
    <p><strong>Trabalho:</strong> {{ $work->overview }}</p>

    <h4>Avaliação realizada</h4>
    <strong>Respostas:</strong>
    <ul>
        @php
            // Decodifica o JSON de respostas
            $responses = json_decode($evaluation->responses, true);
        @endphp

        @foreach($responses as $questionId => $score)
            @php
                // Busca o texto da pergunta pelo ID
                $question = \App\Models\Question::find($questionId);
            @endphp
            
            @if($question)
                <li>
                    <strong>Pergunta: {{ $question->question_text }}</strong> <br>
                    Nota: {{ $score }}
                </li>
            @else
                <li><strong>Pergunta não encontrada</strong></li>
            @endif
        @endforeach
    </ul>

    <a href="{{ route('results.show', $work->id) }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
