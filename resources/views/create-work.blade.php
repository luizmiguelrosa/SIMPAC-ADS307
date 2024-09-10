<!-- resources/views/create-work.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a New Work</h1>

    <!-- Mensagem de sucesso -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulário -->
    <form action="{{ route('admin.store-work') }}" method="POST">
        @csrf

        <!-- Campo de protocolo -->
        <div class="form-group">
            <label for="protocol">Protocol</label>
            <input type="text" class="form-control @error('protocol') is-invalid @enderror" id="protocol" name="protocol" value="{{ old('protocol') }}" required>
            @error('protocol')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Campo de seleção de curso -->
        <div class="form-group">
            <label for="course_id">Course</label>
            <select class="form-control @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                <option value="">Select a course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                @endforeach
            </select>
            @error('course_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Botão de submissão -->
        <button type="submit" class="btn btn-primary">Create Work</button>
    </form>
</div>
@endsection
