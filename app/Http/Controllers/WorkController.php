<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Work;
use App\Models\User;
use App\Models\Symposium; 
use App\Models\EvaluativeModel; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WorkController extends Controller
{
    public function create()
    {
        // Obtém todos os cursos e simpósios ativos e modelo avaliativo
        $courses = Course::all();
        $symposiums = Symposium::whereNull('end_date')->get(); // Simpósios sem data de término
        $evaluators = User::where('type', 2)->get(); // Obtém todos os managers
        $evaluativeModels = EvaluativeModel::all(); //Pega os modelos
    
        return view('admin/works/create-work', compact('courses', 'symposiums', 'evaluators', 'evaluativeModels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'protocol' => 'required|string|max:255',
            'evaluative_model_id' => 'required|exists:evaluative_models,id', // Valida o modelo avaliativo
            'course_id' => 'required|exists:courses,id',
            'evaluators' => 'array', // Aceita um array de IDs
            'evaluators.*' => 'exists:users,id', // Valida que cada ID de avaliador existe na tabela users
        ]);
    
        // Encontra o simpósio ativo
        $activeSymposium = Symposium::whereNull('end_date')->latest()->first();
    
        if (!$activeSymposium) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Nenhum simpósio ativo encontrado.']);
        }
    
        // Cria o novo trabalho e associa ao simpósio ativo
        $work = new Work();
        $work->protocol = $request->input('protocol');
        $work->evaluative_model_id = $request->input('evaluative_model_id'); // Adiciona o modelo avaliativo
        $work->course_id = $request->input('course_id');
        $work->symposium_id = $activeSymposium->id; // Associa ao simpósio ativo
        $work->save();
    
        // Associa os avaliadores ao trabalho
        $work->evaluators()->sync($request->input('evaluators', [])); // Sincroniza os avaliadores
    
        return redirect()->route('admin.home')->with(['status' => 'success', 'message' => 'Trabalho criado com sucesso!']);
    }
    
}