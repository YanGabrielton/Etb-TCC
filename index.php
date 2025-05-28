<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job4You</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="/src/css/global.css">
</head>

<body>

    <!-- Navbar (Menu de Navegação) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
        <!-- Logo do site -->
        <a class="navbar-brand fw-bold" href="index.html">Job4You</a>

        <!-- Botão de menu para celular -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Itens do menu -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Sobre a Empresa</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="/src/pages/cadastro_usuario.php">Cadastre-se</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="btn btn-login" href="./src/pages/login.php">Login</a>

                </li>
            </ul>
        </div>
    </nav>

    <!-- Conteúdo da página -->
    <div class="container main-content hero-section">
        <div class="row align-items-center">

            <div class="col-md-6 mb-4 mb-md-0">
                <img src="/src/img/img3.jpg" alt="Trabalho Informal" class="hero-img">
            </div>

            <div class="col-md-6 text-center text-md-start">
                <h1 class="mb-4 fw-bold">Encontre ou divulgue serviços informais facilmente</h1>
                <p class="mb-4">Na Job4You você encontra prestadores de serviços informais confiáveis ou pode anunciar
                    seu trabalho para milhares de clientes!</p>
                <div>

                    <a href="./src/pages/servicos.php" class="btn btn-outline-primary me-3">Ver Serviços</a>
                    <a href="./src/pages/login.php" class="btn btn-outline-primary">Cadastrar Serviço</a>

                </div>
            </div>
        </div>
    </div>

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