<!-- resources/views/manager/work/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Trabalho</h1>

        <p><strong>Protocolo:</strong> {{ $work->protocol }}</p>
        <p><strong>Curso:</strong> {{ $work->course->name }}</p>
        <p><strong>Modelo Avaliativo:</strong> {{ $work->evaluativeModel->name }}</p>
        <p><strong>Simpósio:</strong> {{ $work->symposium->edition }}</p>

        <!-- Botão para avaliar o trabalho -->
        <form action="{{ route('manager.work.evaluate', $work->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Avaliar</button>
        </form>
    </div>
@endsection
