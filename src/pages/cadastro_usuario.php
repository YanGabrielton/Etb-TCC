<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Job4You</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="../css/global.css">

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
          <a class="btn btn-login" href="./login.php">Login</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Formulário do usuário -->
  <main class="main-content container py-4">
    <h2 class="text-center mb-4">Cadastro de Usuário</h2>
    
    <form action="../backend/includes/processa_cadastra_usuario.php" method="POST">
      <div class="row g-3">
        <div class="col-md-6"><input type="text" name="nome" class="form-control" placeholder="Nome completo" required></div>
        <div class="col-md-6"><input type="text" name="cpf" class="form-control" placeholder="CPF" required></div>
        <div class="col-md-6"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
        <div class="col-md-6"><input type="password" name="senha" class="form-control" placeholder="Senha" required></div>
        <div class="col-md-4"><input type="text" name="cep" class="form-control" placeholder="CEP" required></div>
        <div class="col-md-4"><input type="text" name="estado" class="form-control" placeholder="Estado" required></div>
        <div class="col-md-4"><input type="text" name="cidade" class="form-control" placeholder="Cidade" required></div>
        <div class="col-md-6"><input type="text" name="bairro" class="form-control" placeholder="Bairro" required></div>
        <div class="col-md-6"><input type="text" name="rua" class="form-control" placeholder="Rua" required></div>
        <div class="col-md-6"><input type="text" name="telefone" class="form-control" placeholder="Telefone" required></div>
        <div class="col-md-6"><input type="date" name="data_nascimento" class="form-control" required></div>
      </div>
      <div class="d-grid mt-4"><button type="submit" class="btn btn-login">Cadastrar</button></div>
    </form>
  </main>

  <!-- Footer -->
  <footer>
    <div class="container">
      <p>&copy; 2025 Job4You - Todos os direitos reservados.</p>
    </div>
  </footer>

</body>

</html>
