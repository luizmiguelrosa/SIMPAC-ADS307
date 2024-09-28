@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4" style="font-size: 1.5rem;">Trabalhos Disponíveis para Avaliação</h1>

        @if ($works->isEmpty())
            <p class="text-center">Não há trabalhos disponíveis para avaliação no momento.</p>
        @else
            <div class="row">
                @foreach ($works as $work)
                    @php
                        $evaluated = $work->evaluations->isNotEmpty();
                    @endphp

                    <!-- Tornar todo o card clicável -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <a href="{{ route('manager.work.evaluate', $work->id) }}" class="text-decoration-none">
                            <div class="card shadow-sm {{ $evaluated ? 'border-success' : '' }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $work->overview }}</h5>
                                    <p class="text-muted small">Protocolo: {{ $work->protocol }} | Curso: {{ $work->course->course_name }}</p>

                                    @if ($evaluated)
                                        <span class="badge bg-success">Avaliado</span>
                                    @else
                                        <span class="badge bg-primary">Avaliar</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

<style>
    /* Título responsivo */
    h1 {
        font-size: 1.8rem;
        font-weight: 600;
    }

    /* Estilo dos cards */
    .card {
        border-radius: 8px;
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    /* Tornar o link do card invisível */
    a.text-decoration-none {
        color: inherit;
    }

    a.text-decoration-none:hover {
        text-decoration: none;
    }

    /* Texto pequeno e discreto */
    .text-muted {
        font-size: 0.875rem;
    }

    /* Ajustes para dispositivos móveis */
    @media (max-width: 768px) {
        h1 {
            font-size: 1.4rem;
        }

        .card-title {
            font-size: 1.1rem;
        }
    }
</style>
