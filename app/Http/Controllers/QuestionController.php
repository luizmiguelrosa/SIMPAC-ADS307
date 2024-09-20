<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\EvaluativeModel;

class QuestionController extends Controller
{
    // Método para exibir o formulário de criação de perguntas
    public function create(Request $request)
    {
        $evaluativeModels = EvaluativeModel::all();
        $numQuestions = $request->get('num_questions', 0); // Quantidade de perguntas dinâmica

        return view('questions.create', compact('evaluativeModels', 'numQuestions'));
    }

    // Método para salvar as perguntas no banco de dados
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'evaluative_model_id' => 'required|exists:evaluative_models,id',
            'questions.*' => 'nullable|string|max:255', // Aceita perguntas nulas
        ]);

        $model = EvaluativeModel::findOrFail($validatedData['evaluative_model_id']);

        // Loop para inserir perguntas que não estão vazias
        foreach ($validatedData['questions'] as $questionText) {
            if (!empty($questionText)) {
                $model->questions()->create([
                    'question_text' => $questionText, // Certifique-se de que esse campo exista na tabela de perguntas
                ]);
            }
        }

        return redirect()->route('questions.create')->with('success', 'Perguntas salvas com sucesso!');
    }

    // Método edit comentado por enquanto
    /*
    public function edit($evaluative_model_id)
    {
        $evaluativeModels = EvaluativeModel::all();
        $selectedModel = EvaluativeModel::with('questions')->findOrFail($evaluative_model_id);
        $existingQuestions = $selectedModel->questions;

        return view('questions.create', compact('evaluativeModels', 'selectedModel', 'existingQuestions'));
    }
    */
}
