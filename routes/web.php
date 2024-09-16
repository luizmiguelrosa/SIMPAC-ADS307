<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SymposiumController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\EvaluatorController;
use App\Http\Controllers\EvaluativeModelController;

Route::get('/', function () {
    return view('welcome');
});

//rota para o email
Route::get('send-mail', [MailController::class, 'index']);


Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::match(['get', 'post'], '/admin/symposium/start', [SymposiumController::class, 'startSymposium'])->name('symposium.start');
    Route::match(['get', 'post'], '/admin/symposium/end', [SymposiumController::class, 'endSymposium'])->name('symposium.end');
    Route::get('/admin/create-work', [WorkController::class, 'create'])->name('admin.create-work');
    Route::post('/admin/store-work', [WorkController::class, 'store'])->name('admin.store-work'); //não precisa usar o /admin antes pois não estamos usando uma subpasta admin
    // Rotas para CRUD de cursos
    Route::get('/admin/courses', [CourseController::class, 'index'])->name('courses.index');
    // Formulário para criar novo curso
    Route::get('/admin/courses/create', [CourseController::class, 'create'])->name('courses.create');
    // Armazenar novo curso
    Route::post('/admin/courses', [CourseController::class, 'store'])->name('courses.store');
    // Formulário para editar um curso
    Route::get('/admin/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    // Atualizar um curso
    Route::put('/admin/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    // Excluir um curso
    Route::delete('/admin/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
  
    //Rotas para crud de avaliador:
    Route::get('/admin/evaluators', [EvaluatorController::class, 'index'])->name('evaluators.index');
    Route::get('/admin/evaluators/create', [EvaluatorController::class, 'create'])->name('evaluators.create');
    Route::post('/admin/evaluators', [EvaluatorController::class, 'store'])->name('evaluators.store');
    Route::get('/admin/evaluators/{id}/edit', [EvaluatorController::class, 'edit'])->name('evaluators.edit');
    Route::put('/admin/evaluators/{id}', [EvaluatorController::class, 'update'])->name('evaluators.update');
    Route::delete('/admin/evaluators/{id}', [EvaluatorController::class, 'destroy'])->name('evaluators.destroy');

    // Rotas para CRUD de modelos avaliativos
    Route::get('/admin/evaluative-models', [EvaluativeModelController::class, 'index'])->name('evaluative_models.index');
    Route::get('/admin/evaluative-models/create', [EvaluativeModelController::class, 'create'])->name('evaluative_models.create');
    Route::post('/admin/evaluative-models', [EvaluativeModelController::class, 'store'])->name('evaluative_models.store');
    Route::get('/admin/evaluative-models/{evaluativeModel}/edit', [EvaluativeModelController::class, 'edit'])->name('evaluative_models.edit');
    Route::put('/admin/evaluative-models/{evaluativeModel}', [EvaluativeModelController::class, 'update'])->name('evaluative_models.update');
    Route::delete('/admin/evaluative-models/{evaluativeModel}', [EvaluativeModelController::class, 'destroy'])->name('evaluative_models.destroy');

  
});
  
/*------------------------------------------
--------------------------------------------
All Evaluetor Routes List Trocar nomemclatura depois 
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');

 // Rotas para visualizar trabalhos disponíveis para avaliação
 Route::get('/manager/works', [WorkController::class, 'managerWorks'])->name('manager.works');

 // Outras rotas relacionadas a trabalhos que o manager pode realizar
 Route::get('/manager/works/{work}', [WorkController::class, 'show'])->name('manager.work.show');
 Route::post('/manager/works/{work}/evaluate', [WorkController::class, 'evaluate'])->name('manager.work.evaluate');


});


