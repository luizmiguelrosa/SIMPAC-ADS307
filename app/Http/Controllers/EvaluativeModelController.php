<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluativeModel;
use App\Models\Question;

class EvaluativeModelController extends Controller
{
    public function index()
    {
        $evaluativeModels = EvaluativeModel::all();
        return view('evaluative_models.index', compact('evaluativeModels'));
    }
//---------------------------------------------------------------------------
    public function create()
    {
        return view('evaluative_models.create');
    }
//----------------------------------------------------------------------------
public function store(Request $request)
{
    // Validação do nome do modelo avaliativo
    $request->validate([
        'model_name' => 'required|string|max:255',
    ]);

    // Criação do modelo avaliativo
    $evaluativeModel = EvaluativeModel::create([
        'model_name' => $request->input('model_name'),
    ]);

    // Redireciona para a página de criação de perguntas sem passar ID
    return redirect()->route('questions.create')->with('success', 'Modelo avaliativo criado com sucesso. Agora adicione as perguntas.');
}
//------------------------------------------------------------------------------------------------------------
    public function edit(EvaluativeModel $evaluativeModel)
    {
        return view('evaluative_models.edit', compact('evaluativeModel'));
    }

    public function update(Request $request, EvaluativeModel $evaluativeModel)
    {
      

}
}
