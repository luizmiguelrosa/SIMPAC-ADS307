<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluativeModel;
use App\Models\Question;

class EvaluativeModelController extends Controller
{
    public function index()
    {
        $evaluativeModels = EvaluativeModel::with('questions')->get(); // Incluir perguntas
        return view('admin/evaluative_models.index', compact('evaluativeModels'));
    }

    public function create()
    {
        return view('admin/evaluative_models.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'model_name' => 'required|string|max:255',
        ]);

        EvaluativeModel::create([
            'model_name' => $request->input('model_name'),
        ]);

        return redirect()->route('questions.create')->with('success', 'Modelo avaliativo criado com sucesso. Agora adicione as perguntas.');
    }

    public function edit(EvaluativeModel $evaluativeModel)
    {
        return view('admin/evaluative_models.edit', compact('evaluativeModel'));
    }

    public function update(Request $request, EvaluativeModel $evaluativeModel)
    {
        // Validação
        $request->validate([
            'model_name' => 'required|string|max:255',
        ]);

        // Atualização
        $evaluativeModel->update([
            'model_name' => $request->input('model_name'),
        ]);

        return redirect()->route('evaluative_models.index')->with('success', 'Modelo avaliativo atualizado com sucesso.');
    }

    public function destroy(EvaluativeModel $evaluativeModel)
    {
        // Deleta o modelo avaliativo
        $evaluativeModel->delete();

        return redirect()->route('evaluative_models.index')->with('success', 'Modelo avaliativo deletado com sucesso.');
    }
}
