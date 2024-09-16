<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin/courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin/courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'course_abbreviation' => 'required|string|max:10',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')->with(['status' => 'success', 'message' => 'Curso criado com sucesso!']);
    }

    public function edit(Course $course)
    {
        return view('admin/courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'course_abbreviation' => 'required|string|max:10',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')->with(['status' => 'success', 'message' => 'Curso atualizado com sucesso!']);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with(['status' => 'success', 'message' => 'Curso removido com sucesso!']);
    }
}
