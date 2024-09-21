<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Work;
use App\Models\User;
use App\Models\Symposium; 
use App\Models\Category; 
use App\Models\EvaluativeModel; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WorkController extends Controller
{
    public function create()
    {
        // Obtém todos os cursos e simpósios ativos e categorias e modelo avaliativo
        $courses = Course::all();
        $symposiums = Symposium::whereNull('end_date')->get(); // Simpósios sem data de término
        $evaluators = User::where('type', 2)->get(); // Obtém todos os managers
        $evaluativeModels = EvaluativeModel::all(); //Pega os modelos
        $categories = Category::all(); // Carrega todas as categorias
    
        return view('admin/works/create-work', compact('courses', 'symposiums', 'evaluators', 'evaluativeModels', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'protocol' => 'required|string|max:255',
            'overview' => 'required|string|max:500', //valida se tem resumo e até 500 caracteres
            'evaluative_model_id' => 'required|exists:evaluative_models,id', // Valida o modelo avaliativo
            'course_id' => 'required|exists:courses,id',
            'evaluators' => 'array', // Aceita um array de IDs
            'evaluators.*' => 'exists:users,id', // Valida que cada ID de avaliador existe na tabela users
            'category_id' => 'required|exists:categories,id', // Validação da categoria
        ]);
    
        // Encontra o simpósio ativo
        $activeSymposium = Symposium::whereNull('end_date')->latest()->first();
    
        if (!$activeSymposium) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Nenhum simpósio ativo encontrado.']);
        }
    
        // Cria o novo trabalho e associa ao simpósio ativo
        $work = new Work();
        $work->protocol = $request->input('protocol');
        $work->overview = $request->input('overview');
        $work->evaluative_model_id = $request->input('evaluative_model_id'); // Adiciona o modelo avaliativo
        $work->course_id = $request->input('course_id');
        $work->category_id = $request->input('category_id'); // Adiciona a categoria
        $work->symposium_id = $activeSymposium->id; // Associa ao simpósio ativo
        $work->save();
    
        // Associa os avaliadores ao trabalho
        $work->evaluators()->sync($request->input('evaluators', [])); // Sincroniza os avaliadores
    
        return redirect()->route('admin.home')->with(['status' => 'success', 'message' => 'Trabalho criado com sucesso!']);
    }
    // ---------------------------------PARTE DE AVALIADORES---------------------------------------
    //  método que irá buscar os trabalhos que o usuário pode avaliar e passar esses dados para a view.
    public function managerWorks()
    {
        $userId = Auth::id(); // Obtém o ID do usuário autenticado
    
        // Carrega as relações com eager loading
        $works = Work::with('course', 'evaluative_model')
                     ->whereHas('evaluators', function ($query) use ($userId) {
                         $query->where('user_id', $userId);
                     })
                     ->get();
    
        // Dump para verificar os resultados
       // dd($works);
    
        return view('manager.works', compact('works'));
    }
    


    //--------------------------------------------------------------------
    public function show(Work $work)
    {
        return view('manager.work.show', compact('work'));
    }
    
    public function evaluate(Work $work)
    {
        // Associa o trabalho ao manager que está avaliando
        $work->evaluators()->syncWithoutDetaching([Auth::id()]);
    
        return redirect()->route('manager.works')->with('success', 'Trabalho avaliado com sucesso!');
    }

}