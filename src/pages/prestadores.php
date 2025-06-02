<?php
session_start();

include '../backend/config/ConexaoBanco.php';

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job4You</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="/src/css/global.css">
</head>

<body>

    <!-- Navbar (Menu de Navegação) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
        <a class="navbar-brand fw-bold" href="/index.php">Job4You</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="/index.php">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Sobre a Empresa</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="./cadastro_usuario.php">Cadastre-se</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="btn btn-login" href="/src/pages/login.php">Login</a>
                </li>
                <li><a href="../backend/includes/logout.php">Sair</a></li>
            </ul>
        </div>
    </nav>


    <!-- Barra de pesquisa -->
    <header class="text-center py-5 bg-light">
        <div class="container">
            <h1 class="fw-bold">Encontre prestadores de serviços informais</h1>
            <p class="lead">Busque por nome ou cidade</p>
            <div class="row justify-content-center mt-4">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Pesquisar prestador...">
                        <button class="btn btn-warning fw-bold text-black" type="button">Pesquisar</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Prestadores -->
    <section class="container py-5">
        <div class="row justify-content-center g-4">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <img src="/src/img/fotoperfil.jpg" width="100" height="100" alt="Prestador">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Nome do prestador</h5>
                        <p class="card-text text-muted mb-1">Cidade tal, sigla</p>
                        <p class="card-text">Horario de atendimento: 08:00 às 18:00 de segunda a sexta</p>
                        <a href="login.html" class="btn btn-warning">Ver perfil</a>
                    </div>
                </div>
            </div>

            <!-- Repetição para cada prestador (cards) -->
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <img src="/src/img/fotoperfil.jpg" width="100" height="100" alt="Prestador">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Nome do prestador</h5>
                        <p class="card-text text-muted mb-1">Cidade tal, sigla</p>
                        <p class="card-text">Horario de atendimento: 08:00 às 18:00 de segunda a sexta</p>
                        <a href="#" class="btn btn-warning">Ver perfil</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <img src="/src/img/fotoperfil.jpg" width="100" height="100" alt="Prestador">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Nome do prestador</h5>
                        <p class="card-text text-muted mb-1">Cidade tal, sigla</p>
                        <p class="card-text">Horario de atendimento: 08:00 às 18:00 de segunda a sexta</p>
                        <a href="#" class="btn btn-warning">Ver perfil</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <img src="/src/img/fotoperfil.jpg" width="100" height="100" alt="Prestador">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Nome do prestador</h5>
                        <p class="card-text text-muted mb-1">Cidade tal, sigla</p>
                        <p class="card-text">Horario de atendimento: 08:00 às 18:00 de segunda a sexta</p>
                        <a href="#" class="btn btn-warning">Ver perfil</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <img src="/src/img/fotoperfil.jpg" width="100" height="100" alt="Prestador">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Nome do prestador</h5>
                        <p class="card-text text-muted mb-1">Cidade tal, sigla</p>
                        <p class="card-text">Horario de atendimento: 08:00 às 18:00 de segunda a sexta</p>
                        <a href="#" class="btn btn-warning">Ver perfil</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <img src="/src/img/fotoperfil.jpg" width="100" height="100" alt="Prestador">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Nome do prestador</h5>
                        <p class="card-text text-muted mb-1">Cidade tal, sigla</p>
                        <p class="card-text">Horario de atendimento: 08:00 às 18:00 de segunda a sexta</p>
                        <a href="#" class="btn btn-warning">Ver perfil</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="mb-0">© 2025 Job4You - Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle (JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>