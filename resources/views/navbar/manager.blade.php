@extends('navbar.index')

@section('navbar.user')
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{ route('manager.home') }}">Inicio</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">Resultados</a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Trabalhos
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Cadastrar</a></li>
        <li><a class="dropdown-item" href="#">Visualizar</a></li>
        <li><a class="dropdown-item" href="#">Atualizar</a></li>
    </ul>
</li>
@endsection