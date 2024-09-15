<!-- resources/views/manager/works.blade.php -->
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
                        <th>Simpósio</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($works as $work)
                        <tr>
                            <td>{{ $work->protocol }}</td>
                            <td>{{ $work->course->course_name ?? 'Não disponível' }}</td> <!--Cuidado com o nome q tá no banco de dados, tipo course_name-->
                            <td> {{ $work->evaluative_model->model_name ?? 'Não disponível' }}</td> 
                            <td> {{ $work->evaluative_model->edition ?? 'Não disponível' }}</td> 
<!--Ainda está dificil ler as variaveis -->
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
