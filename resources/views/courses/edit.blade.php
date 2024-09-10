@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Course</h1>

    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name" value="{{ $course->course_name }}" required>
        </div>
        
        <div class="form-group">
            <label for="course_abbreviation">Course Abbreviation</label>
            <input type="text" class="form-control" id="course_abbreviation" name="course_abbreviation" value="{{ $course->course_abbreviation }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
