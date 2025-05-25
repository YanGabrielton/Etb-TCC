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
                    <a class="nav-link" href="/src/pages/cadastro_usuario.php">Cadastre-se</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="btn btn-login" href="/src/pages/login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Formulário de login -->
    <main class="main-content d-flex align-items-center justify-content-center">
        <div class="login-card">
            <h2 class="text-center mb-4">Login</h2>
            <form action="/backend/processa_login.php" method="POST">
                <div class="mb-3">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                </div>

                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-login">Entrar</button>
                </div>
                <div class="text-center">
                    <a href="/src/pages/cadastro_usuario.php" class="btn btn-outline-secondary w-100">Criar uma conta</a>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Job4You - Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="js/login.js"></script>
</body>

</html>
