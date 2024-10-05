<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\EvaluativeModel;

class QuestionController extends Controller
{
    // Método para exibir as perguntas associadas a um modelo avaliativo
    public function index(Request $request)
    {
        // Carrega todos os modelos avaliativos para o dropdown
        $evaluativeModels = EvaluativeModel::all();

        // Obtém o ID do modelo avaliativo selecionado, se houver
        $selectedModelId = $request->get('evaluative_model_id');

        // Inicializa a variável de perguntas
        $questions = [];

        // Se um modelo for selecionado, carrega as perguntas associadas
        if ($selectedModelId) {
            $selectedModel = EvaluativeModel::with('questions')->findOrFail($selectedModelId);
            $questions = $selectedModel->questions; // Carrega as perguntas
        }

        return view('questions.index', compact('evaluativeModels', 'questions', 'selectedModelId'));
    }
     // Método para exibir o formulário de edição de uma pergunta
     public function edit(Question $question)
     {
         return view('questions.edit', compact('question'));
     }
 
     // Método para atualizar a pergunta no banco de dados
     public function update(Request $request, Question $question)
     {
         $validatedData = $request->validate([
             'question_text' => 'required|string|max:255',
         ]);
 
         $question->update($validatedData);
 
         return redirect()->route('questions.index', ['evaluative_model_id' => $question->evaluative_model_id])
                          ->with('success', 'Pergunta atualizada com sucesso!');
     }
 
     // Método para excluir a pergunta
     public function destroy(Question $question)
     {
         $question->delete();
 
         return redirect()->route('questions.index', ['evaluative_model_id' => $question->evaluative_model_id])
                          ->with('success', 'Pergunta excluída com sucesso!');
     }
      // Método para salvar as perguntas no banco de dados
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'evaluative_model_id' => 'required|exists:evaluative_models,id',
            'question_text' => 'required|string|max:255',
        ]);

        $model = EvaluativeModel::findOrFail($validatedData['evaluative_model_id']);

        // Criação da nova pergunta associada ao modelo avaliativo
        $model->questions()->create([
            'question_text' => $validatedData['question_text'],
        ]);

        return redirect()->route('questions.index', ['evaluative_model_id' => $model->id])
                         ->with('success', 'Pergunta adicionada com sucesso!');
    }
}
