<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\EvaluatorCreatedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail; // Importa o DemoMail

class EvaluatorController extends Controller
{
    // Lista todos os avaliadores
    public function index()
    {
        $evaluators = User::where('type', 2)->get(); // Lista apenas usuários do tipo 2 (manager)
        return view('admin/evaluators.index', compact('evaluators'));
    }

    // Exibe o formulário de criação de avaliador
    public function create()
    {
        return view('admin/evaluators.create');
    }

    // Salva um novo avaliador e envia o email
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);
    
        // Gerar senha aleatória
        $randomPassword = mt_rand(1000, 9999);
        $hashedPassword = Hash::make($randomPassword);
    
        // Cria o avaliador no banco de dados
        $evaluator = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $hashedPassword,
            'type' => 2, // Define o tipo como manager (2)
        ]);
    
        // Dados para enviar no e-mail
        $mailData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $randomPassword // Envia a senha original (sem hash) para o e-mail
        ];
    
        // Envia o e-mail ao avaliador criado
        Mail::to($evaluator->email)->send(new DemoMail($mailData));
    
        // Redireciona para a página de lista de avaliadores
        return redirect()->route('evaluators.index')->with(['status' => 'success', 'message' => 'Avaliador criado e e-mail enviado com sucesso!']);
    }   

    // Exibe o formulário de edição do avaliador
    public function edit($id)
    {
        $evaluator = User::findOrFail($id);
        return view('admin/evaluators.edit', compact('evaluator'));
    }

    // Atualiza os dados de um avaliador
    public function update(Request $request, $id)
    {
        $evaluator = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
           //'password' => 'nullable|string|min:6|confirmed',
        ]);

        $evaluator->name = $request->input('name');
        $evaluator->email = $request->input('email');
        
        if ($request->input('password')) {
            $evaluator->password = Hash::make($request->input('password'));
        }

        $evaluator->save();

        return redirect()->route('evaluators.index')->with(['status' => 'success', 'message' => 'Avaliador atualizado com sucesso!']);
    }   

    // Exclui um avaliador
    public function destroy($id)
    {
        $evaluator = User::findOrFail($id);
        $evaluator->delete();

        return redirect()->route('evaluators.index')->with(['status' => 'success', 'message' => 'Avaliador removido com sucesso!']);
    }
    // Exibe as avaliações de um avaliador
    public function show($id)
    {
        // Recupera o avaliador e suas avaliações
        $evaluator = User::with('evaluations.work')->findOrFail($id);

        return view('admin/evaluators.show', compact('evaluator'));
    }

}
