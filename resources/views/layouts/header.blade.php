<header>
            <nav class="navbar bg-body-tertiary fixed-top">
                <div class="container-fluid">
                    <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="d-flex flex-grow-1 justify-content-center">
                        <a class="navbar-brand">
                            <img src="/assets/univicosa_horizontal.LOGO.png" alt="Logo da Univicosa" class="img-fluid" style="max-width: 200px; width: 100%; height: auto;">
                        </a>
                    </div>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#">Inicio</a>
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
                                        <li><a class="dropdown-item" href="#">Cadastrar</a></li>
                                        <li><a class="dropdown-item" href="#">Visualizar</a></li>
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
                                        <li><a class="dropdown-item" href="#">Perguntas</a></li>
                                        <li><a class="dropdown-item" href="#">Modelo Avaliativo</a></li>
                                        <li><a class="dropdown-item" href="#">Cursos</a></li>
                                        
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Sair</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <style>
            /* Cor de fundo do botão */
            .navbar-toggler.custom-toggler {
                background-color: #205483; /* Azul */
                border-color: #205483;
            }
        
            /* Cor do ícone do hambúrguer */
            .navbar-toggler.custom-toggler .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
                /* Cor branca no ícone */
            }
        
            /* Opcional: ajustar o tamanho do ícone */
            .navbar-toggler-icon {
                width: 1.5em;
                height: 1.5em;
            }
        </style>
