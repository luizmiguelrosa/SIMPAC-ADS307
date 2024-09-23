@extends('navbar.index')

@section('navbar.user')
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{ route('admin.home') }}">Inicio</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.results.index') }}">Resultados</a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Trabalhos
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('admin.create-work') }}">Cadastrar</a></li>
        <li><a class="dropdown-item" href="{{ route('works.index') }}">Visualizar</a></li>
        <li><a class="dropdown-item" href="#">Atualizar</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="#">Apagar</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Avaliadores
    </a>
    <ul class="dropdown-menu">
         <!-- Link para a página de criação de avaliadores -->
        <li><a class="dropdown-item" href="{{ route('evaluators.create') }}">Cadastrar</a></li>
        
        <!-- Link para a página que lista todos os avaliadores -->
        <li><a class="dropdown-item" href="{{ route('evaluators.index') }}">Visualizar</a></li>
        <li><a class="dropdown-item" href="#">Atualizar</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="#">Apagar</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Configurações Internas
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('questions.create') }}">Perguntas</a></li>
        <li><a class="dropdown-item" href="{{ route('evaluative_models.index') }}">Modelo Avaliativo</a></li>
        <li><a class="dropdown-item" href="{{ route('courses.index') }}">Cursos</a></li>
        <li><a class="dropdown-item" href="{{ route('categories.index') }}">Categorias</a></li>
    </ul>
</li>
@endsection