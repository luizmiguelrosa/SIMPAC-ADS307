@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Course</h1>

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name" required>
        </div>
        
        <div class="form-group">
            <label for="course_abbreviation">Course Abbreviation</label>
            <input type="text" class="form-control" id="course_abbreviation" name="course_abbreviation" required>
        </div>
        
        <button type="submit" class="btn btn-custom mt-3">Save</button>
    </form>
</div>
@endsection
