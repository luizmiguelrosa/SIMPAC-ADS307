@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Criar Novo Curso</h1>

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="form-group  mb-3">
            <label for="course_name">Nome do Curso</label>
            <input type="text" class="form-control" id="course_name" name="course_name" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="course_abbreviation">Abreviação do Curso</label>
            <input type="text" class="form-control" id="course_abbreviation" name="course_abbreviation" required>
        </div>
        
        <div class="btn-container justify-content">
            <a href="{{ route('courses.index') }}" class="btn btn-custom-red">Cancelar</a>
            <button type="submit" class="btn btn-custom">Criar</button>
        </div>
    </form>
</div>
@endsection
