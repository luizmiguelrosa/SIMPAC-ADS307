<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\EvaluativeModel;
use App\Models\Course;
use App\Models\Category;

class ResultController extends Controller
{
    //
    
    public function index(Request $request)
    {
        // Carrega os modelos avaliativos e as categorias para os filtros
        $evaluativeModels = EvaluativeModel::all();
        $categories = Category::all();
      //  $courses = Course::all(); // Não deu certo em p´rimeiro momento Carrega todos os cursos

        // Filtra por curso, modelo avaliativo ou categoria
        $query = Work::query();

        if ($request->filled('course')) {
            $query->whereHas('course', function ($q) use ($request) {
                $q->where('course_abbreviation', $request->course);
            });
        }

        if ($request->filled('evaluative_model')) {
            $query->where('evaluative_model_id', $request->evaluative_model);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Carrega os trabalhos e suas avaliações
        $works = $query->with(['evaluations', 'course', 'evaluative_model', 'category'])->get();

        // Calcula a nota média para cada trabalho
        $works->each(function ($work) {
            $totalScore = 0;
            $totalQuestions = 0;

            foreach ($work->evaluations as $evaluation) {
                $responses = json_decode($evaluation->responses, true);
                $totalScore += array_sum($responses);
                $totalQuestions += count($responses);
            }

            $work->average_score = $totalQuestions > 0 ? $totalScore / $totalQuestions : null;
        });

        // Retorna a view com os dados
        return view('admin.results.index', compact('works', 'evaluativeModels', 'categories'));
    }
}
