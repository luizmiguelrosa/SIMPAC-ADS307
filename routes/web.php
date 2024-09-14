<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SymposiumController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\EvaluatorController;

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
    Route::match(['get', 'post'], '/symposium/start', [SymposiumController::class, 'startSymposium'])->name('symposium.start');
    Route::match(['get', 'post'], '/symposium/end', [SymposiumController::class, 'endSymposium'])->name('symposium.end');
    Route::get('/create-work', [WorkController::class, 'create'])->name('admin.create-work');
    Route::post('/store-work', [WorkController::class, 'store'])->name('admin.store-work'); //não precisa usar o /admin antes pois não estamos usando uma subpasta admin
    // Rotas para CRUD de cursos
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    // Formulário para criar novo curso
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    // Armazenar novo curso
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    // Formulário para editar um curso
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    // Atualizar um curso
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    // Excluir um curso
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
  
    //Rotas para crud de avaliador:
    Route::get('evaluators', [EvaluatorController::class, 'index'])->name('evaluators.index');
    Route::get('evaluators/create', [EvaluatorController::class, 'create'])->name('evaluators.create');
    Route::post('evaluators', [EvaluatorController::class, 'store'])->name('evaluators.store');
    Route::get('evaluators/{id}/edit', [EvaluatorController::class, 'edit'])->name('evaluators.edit');
    Route::put('evaluators/{id}', [EvaluatorController::class, 'update'])->name('evaluators.update');
    Route::delete('evaluators/{id}', [EvaluatorController::class, 'destroy'])->name('evaluators.destroy');
  
});
  
/*------------------------------------------
--------------------------------------------
All Evaluetor Routes List Trocar nomemclatura depois 
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});


