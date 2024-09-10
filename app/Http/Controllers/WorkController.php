<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Work;

class WorkController extends Controller
{
    //
     // Exibir o formulário de criação de trabalho
     public function create()
     {
         // Buscar todos os cursos do banco de dados
         $courses = Course::all();
 
         // Retornar a view com os cursos
         return view('create-work', compact('courses'));
     }
 
     // Armazenar o novo trabalho no banco de dados
     public function store(Request $request)
     {
         // Validação do formulário
         $validated = $request->validate([
             'protocol' => 'required|string|max:255',
             'course_id' => 'required|exists:courses,id',
         ]);
 
         // Criação do novo trabalho
         Work::create([
             'protocol' => $validated['protocol'],
             'course_id' => $validated['course_id'],
         ]);
 
         // Redireciona com uma mensagem de sucesso
         return redirect()->route('admin.create-work')->with('success', 'Work created successfully!');
     }
}
