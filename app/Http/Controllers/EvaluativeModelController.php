<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluativeModel;

class EvaluativeModelController extends Controller
{
    public function index()
    {
        $evaluativeModels = EvaluativeModel::all();
        return view('evaluative_models.index', compact('evaluativeModels'));
    }

    public function create()
    {
        return view('evaluative_models.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'model_name' => 'required|string|max:255',
        ]);

        EvaluativeModel::create($request->all());

        return redirect()->route('evaluative_models.index')->with('success', 'Evaluative Model created successfully.');
    }

    public function edit(EvaluativeModel $evaluativeModel)
    {
        return view('evaluative_models.edit', compact('evaluativeModel'));
    }

    public function update(Request $request, EvaluativeModel $evaluativeModel)
    {
        $request->validate([
            'model_name' => 'required|string|max:255',
        ]);

        $evaluativeModel->update($request->all());

        return redirect()->route('evaluative_models.index')->with('success', 'Evaluative Model updated successfully.');
    }

    public function destroy(EvaluativeModel $evaluativeModel)
    {
        $evaluativeModel->delete();
        return redirect()->route('evaluative_models.index')->with('success', 'Evaluative Model deleted successfully.');
    }
}
