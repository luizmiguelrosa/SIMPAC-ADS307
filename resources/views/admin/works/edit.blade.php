@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Editar Trabalho: {{ $work->protocol }}</h1>

    <!-- Formulário de Edição de Trabalho -->
    <form method="POST" action="{{ route('admin.update-work', $work->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <label for="protocol">Protocolo:</label>
                <input type="text" name="protocol" id="protocol" class="form-control" value="{{ $work->protocol }}" required>
            </div>

            <div class="col-md-6">
                <label for="overview">Resumo:</label>
                <input type="text" name="overview" id="overview" class="form-control" value="{{ $work->overview }}" required>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="course_id">Curso:</label>
                <select name="course_id" id="course_id" class="form-control" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $work->course_id == $course->id ? 'selected' : '' }}>
                            {{ $course->course_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="category_id">Categoria:</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $work->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <label for="evaluative_model_id">Modelo Avaliativo:</label>
                <select name="evaluative_model_id" id="evaluative_model_id" class="form-control" required>
                    @foreach($evaluativeModels as $model)
                        <option value="{{ $model->id }}" {{ $work->evaluative_model_id == $model->id ? 'selected' : '' }}>
                            {{ $model->model_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Atualizar Trabalho</button>
    </form>
</div>
@endsection
