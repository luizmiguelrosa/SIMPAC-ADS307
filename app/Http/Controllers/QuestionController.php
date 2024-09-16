<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\EvaluativeModel;

class QuestionController extends Controller
{
    public function create()
    {
         // Recupera todos os modelos avaliativos
         $evaluativeModels = EvaluativeModel::all();
        // Apenas exibe uma página em branco para adicionar perguntas
        return view('questions.create', compact('evaluativeModels'));
    }
    
    
    public function store(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'evaluative_model_id' => 'required|exists:evaluative_models,id',
            'questions' => 'array|min:1',
            'questions.*' => 'string|max:255',
        ]);

        // Recupera o ID do modelo avaliativo
        $model_id = $request->input('evaluative_model_id');

        // Adiciona as perguntas ao banco de dados
        foreach ($request->input('questions') as $question_text) {
            if ($question_text) {
                Question::create([
                    'evaluative_model_id' => $model_id,
                    'question_text' => $question_text,
                ]);
            }
        }

        return redirect()->route('questions.create')
            ->with('success', 'Perguntas adicionadas com sucesso.');
    }
}