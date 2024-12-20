@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modelos Avaliativos</h1>
    <a href="{{ route('evaluative_models.create') }}" class="btn btn-primary mb-3">Adicionar Novo Modelo Avaliativo</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Quantidade de Perguntas</th> <!-- Nova coluna para quantidade de perguntas -->
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($evaluativeModels as $evaluativeModel)
                <tr>
                    <td>{{ $evaluativeModel->model_name }}</td>
                    <td>
                        <a href="{{ route('evaluative_models.edit', $evaluativeModel->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('evaluative_models.destroy', $evaluativeModel->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete('{{ $evaluativeModel->model_name }}')">Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(modelName) {
        return confirm(`Tem certeza de que deseja excluir o modelo avaliativo "${modelName}"?`);
    }
</script>
@endsection
