@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Trabalhos Disponíveis para Avaliação</h1>

        @if ($works->isEmpty())
            <p>Não há trabalhos disponíveis para avaliação no momento.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Protocolo</th>
                        <th>Curso</th>
                        <th>Modelo Avaliativo</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($works as $work)
                        <tr>
                            <td>{{ $work->protocol }}</td>
                            <td>{{ $work->course->course_abbreviation ?? 'Não disponível' }}</td>
                            <td>{{ $work->evaluative_model->model_name ?? 'Não disponível' }}</td>
                            <td>
                                <a href="{{ route('manager.work.evaluate', $work->id) }}" class="btn btn-primary">Avaliar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
