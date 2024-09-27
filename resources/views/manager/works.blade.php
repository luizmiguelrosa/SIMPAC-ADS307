@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Trabalhos Disponíveis para Avaliação</h1>

        @if ($works->isEmpty())
            <p>Não há trabalhos disponíveis para avaliação no momento.</p>
        @else
            <div class="table-responsive">
                <table class="table text-center"> <!-- Tabela centralizada e com stripes -->
                    <thead>
                        <tr>
                            <th>Resumo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($works as $work)
                            @php
                                // Verifica se o trabalho já foi avaliado
                                $evaluated = $work->evaluations->isNotEmpty();
                                // Limitar a quantidade de palavras no overview
                                $overview_excerpt = Str::words($work->overview, 10, '...');
                            @endphp
                            <tr class="{{ $evaluated ? 'table-success' : '' }}"> <!-- Linha verde se já avaliado -->
                                <td data-toggle="tooltip" title="{{ $work->overview }}">{{ Str::words($work->overview, 5, '...') }}</td>
                                <!--<td>{{ $work->course->course_abbreviation ?? 'Não disponível' }}</td>
                                <td>{{ $work->evaluative_model->model_name ?? 'Não disponível' }}</td> -->
                                <td>
                                    @if ($evaluated)
                                        <span>Avaliado</span>
                                    @else
                                        <a href="{{ route('manager.work.evaluate', $work->id) }}" class="btn btn-primary btn-sm">Avaliar</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@media (max-width: 768px) {
    table th, table td {
        white-space: nowrap;
        font-size: 14px;
    }
}

<style>
    body {
    font-size: 16px; /* Tamanho padrão para corpo de texto */
}

h1 {
    font-size: 28px; /* Títulos maiores */
}

h2 {
    font-size: 24px;
}

h3 {
    font-size: 20px;
}

button {
    font-size: 16px; /* Tamanho de fonte dos botões */
}

@media (max-width: 768px) {
    body {
        font-size: 14px; /* Ajuste para dispositivos móveis */
    }
}

</style>