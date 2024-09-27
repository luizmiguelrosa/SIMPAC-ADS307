@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Avaliar Trabalho: {{ $work->overview }}</h1>

    <form action="{{ route('manager.works.storeEvaluation', $work->id) }}" method="POST">
        @csrf
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center"> <!-- Tabela com bordas e linhas de grade -->
                <thead class="thead-light">
                    <tr>
                        <th>Pergunta</th>
                        <th>Resposta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            <td class="align-middle">{{ $question->question_text }}</td>
                            <td>
                                <input 
                                    type="number" 
                                    name="responses[{{ $question->id }}]" 
                                    class="form-control" 
                                    min="0"
                                    max="10" 
                                    step="0.1" 
                                    required 
                                    style="max-width: 100px; margin: auto; padding: 8px;"> <!-- Input centralizado -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            <a href="{{ route('manager.works') }}" class="btn btn-secondary btn-lg" style="padding: 15px 30px;">
                Cancelar
            </a> <!--trocar depois o estilo desse botao-->
            <button type="submit" class="btn btn-primary btn-lg" style="padding: 15px 30px; margin-right: 10px;">
                Enviar Avaliação
            </button>
            
        </div>
    </form>
</div>
@endsection
