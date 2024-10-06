<h3>Avaliação de {{ $evaluation->evaluator->name }} para o trabalho {{ $work->title }}</h3>

<p><strong>Avaliador:</strong> {{ $evaluation->evaluator->name }}</p>

<p><strong>Respostas:</strong></p>
<ul>
    @php
        $responses = json_decode($evaluation->responses, true);
    @endphp

    @foreach($responses as $question => $score)
        <li><strong>Pergunta {{ $question }}:</strong> Nota {{ $score }}</li>
    @endforeach
</ul>
