<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Work;
use App\Models\User;
use App\Models\Symposium; 
use App\Models\Category; 
use App\Models\Evaluation; 
use App\Models\EvaluativeModel; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WorkController extends Controller
{
    public function index(Request $request)
{
    $courses = Course::all();
    $symposiums = Symposium::whereNull('end_date')->get(); // Simpósios sem data de término
    $evaluators = User::where('type', 2)->get(); // Obtém todos os avaliadores
    $evaluativeModels = EvaluativeModel::all(); // Pega os modelos
    $categories = Category::all(); // Carrega todas as categorias
    $symposiums = Symposium::all(); // Carrega todos os simposios

    // Inicia a query de busca dos trabalhos
    $query = Work::query();

    // Filtros opcionais
    if ($request->filled('course')) {
        $query->whereHas('course', function($q) use ($request) {
            $q->where('course_name', 'like', '%' . $request->course . '%');
        });
    }

    if ($request->filled('evaluative_model')) {
        $query->where('evaluative_model_id', $request->evaluative_model);
    }

    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // Retorna a lista de trabalhos filtrados
    $works = $query->get();

    return view('admin.works.index', compact('courses', 'symposiums', 'evaluators', 'evaluativeModels', 'categories', 'works'));
}
    
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

    public function edit($id)
{
    $work = Work::findOrFail($id); // Encontra o trabalho pelo ID ou lança um erro 404
    $courses = Course::all();
    $evaluativeModels = EvaluativeModel::all();
    $categories = Category::all();

    // Retorna a view de edição com os dados do trabalho e demais informações necessárias
    return view('admin.works.edit', compact('work', 'courses', 'evaluativeModels', 'categories'));
}

public function destroy($id)
{
    $work = Work::findOrFail($id); // Encontra o trabalho pelo ID
    $work->delete(); // Deleta o trabalho

    // Redireciona de volta à página de trabalhos com uma mensagem de sucesso
    return redirect()->route('works.index')->with('success', 'Trabalho deletado com sucesso!');
}
public function update(Request $request, $id)
{
    $work = Work::findOrFail($id); // Encontra o trabalho pelo ID

    // Valida os dados do formulário
    $request->validate([
        'protocol' => 'required|string|max:255',
        'overview' => 'required|string',
        'course_id' => 'required|exists:courses,id',
        'category_id' => 'required|exists:categories,id',
        'evaluative_model_id' => 'required|exists:evaluative_models,id',
    ]);

    // Atualiza os dados do trabalho
    $work->update($request->all());

    // Redireciona de volta à página de trabalhos com uma mensagem de sucesso
    return redirect()->route('works.index')->with('success', 'Trabalho atualizado com sucesso!');
}


    // ---------------------------------PARTE DE AVALIADORES---------------------------------------
    //  método que irá buscar os trabalhos que o usuário pode avaliar e passar esses dados para a view.
    public function managerWorks()
    {
        $userId = Auth::id(); // Obtém o ID do usuário autenticado
    
        // Carrega os trabalhos e verifica se o usuário autenticado já os avaliou
        $works = Work::with(['course', 'evaluative_model', 'evaluations' => function($query) use ($userId) {
            $query->where('evaluator_id', $userId); // Filtra por avaliador autenticado
        }])->whereHas('evaluators', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
    
        return view('manager.works', compact('works'));
    }
    
    


    //--------------------------------------------------------------------
    // Aqui  começa a parte de avaliar o trabalho
    public function show(Work $work)
    {
        return view('manager.work.show', compact('work'));
    }
    
    public function evaluateForm(Work $work)
{
    // Carrega as perguntas relacionadas ao modelo avaliativo
    $questions = $work->evaluative_model->questions; // Certifique-se de que a relação questions está definida no modelo EvaluativeModel

    return view('manager.evaluate', compact('work', 'questions'));
}

public function storeEvaluation(Request $request, Work $work)
{
    $request->validate([
        'responses' => 'required|array', // Validação para as respostas
        'responses.*' => 'required|numeric', // Cada resposta deve ser um número
    ]);

    $evaluation = new Evaluation();
    $evaluation->work_id = $work->id;
    $evaluation->evaluator_id = Auth::id(); // Altera para 'user_id' para se alinhar com a estrutura
    $evaluation->evaluative_model_id = $work->evaluative_model_id; // Associa o modelo avaliativo
    $evaluation->responses = json_encode($request->responses); // Armazena as respostas em JSON
    $evaluation->save();

    return redirect()->route('manager.works')->with('success', 'Avaliação armazenada com sucesso!');
}



}