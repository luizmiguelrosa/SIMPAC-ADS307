<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Listar todas as categorias
    public function index()
    {
        $categories = Category::all(); // Pega todas as categorias
        return view('admin.categories.index', compact('categories'));
    }

    // Mostrar o formulário para criar uma nova categoria
    public function create()
    {
        return view('admin/categories.create');
    }

    // Armazenar uma nova categoria
    public function store(Request $request)
    {
        // Valida o input
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Cria uma nova categoria
        Category::create([
            'category_name' => $request->input('category_name'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Categoria criada com sucesso!');
    }

    // Mostrar o formulário para editar uma categoria existente
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Atualizar uma categoria existente
    public function update(Request $request, Category $category)
    {
        // Valida o input
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Atualiza a categoria
        $category->update([
            'category_name' => $request->input('category_name'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    // Excluir uma categoria
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Categoria excluída com sucesso!');
    }
}
