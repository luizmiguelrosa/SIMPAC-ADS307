@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Editar Curso</h1>

    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="course_name">Nome do Curso</label>
            <input type="text" class="form-control" id="course_name" name="course_name" value="{{ $course->course_name }}" required>
        </div>
        
        <div class="form-group">
            <label for="course_abbreviation">Abreviação do Curso</label>
            <input type="text" class="form-control" id="course_abbreviation" name="course_abbreviation" value="{{ $course->course_abbreviation }}" required>
        </div>
        <a href="{{ route('courses.index') }}" class="btn btn-custom-red mt-3">Cancelar</a>
        <button type="submit" class="btn btn-custom mt-3">Atualizar</button>
    </form>
</div>
@endsection
