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
    // Carrega os modelos avaliativos, categorias e cursos para os filtros
    $evaluativeModels = EvaluativeModel::all();
    $categories = Category::all();
    $courses = Course::all();

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
    return view('admin.results.index', compact('works', 'evaluativeModels', 'categories', 'courses'));
}

    //Função para exibir os detalhes de cada trabalho
    //Estou reutizalndo o metodo para calcular, criar uma função depois para evitar redundancia
    public function show($id)
{
    // Carrega o trabalho com as relações necessárias, incluindo os avaliadores e avaliações
    $work = Work::with(['evaluations.evaluator', 'course', 'evaluative_model', 'category'])->findOrFail($id);

    // Calcula a nota média para este trabalho
    $totalScore = 0;
    $totalQuestions = 0;

    foreach ($work->evaluations as $evaluation) {
        $responses = json_decode($evaluation->responses, true);
        $totalScore += array_sum($responses);
        $totalQuestions += count($responses);
    }

    $work->average_score = $totalQuestions > 0 ? $totalScore / $totalQuestions : null;

    // Retorna a view com os dados, incluindo os avaliadores e suas notas
    return view('admin.results.show', compact('work'));
}
public function showEvaluatorEvaluation($workId, $evaluatorId)
{
    // Carrega o trabalho com as avaliações do avaliador específico
    $work = Work::with(['evaluations' => function($query) use ($evaluatorId) {
        $query->where('evaluator_id', $evaluatorId);
    }])->findOrFail($workId);

    // Verifica se a avaliação existe para este avaliador
    if ($work->evaluations->isEmpty()) {
        abort(404, 'Avaliação não encontrada para este avaliador.');
    }

    $evaluation = $work->evaluations->first(); // Há apenas uma avaliação do avaliador

    return view('admin.results.evaluator-evaluation', compact('work', 'evaluation'));
}



}
