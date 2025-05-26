<?php
session_start();

include '../backend/config/ConexaoBanco.php';

$database = new DataBase();
$conexao = $database->getConnection();

// Buscar categorias para o select
$categorias = $conexao->query("SELECT ID, Nome FROM CategoriaServico");
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
    <a class="navbar-brand fw-bold" href="/index.html">Job4You</a>

    <!-- Botão de menu para celular -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Itens do menu -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item mx-2">
          <a class="nav-link" href="/index.html">Home</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="#">Sobre a Empresa</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="/src/pages/cadastro_usuario.html">Cadastre-se</a>
        </li>
        <li class="nav-item mx-2">
          <a class="btn btn-login" href="/src/pages/login.html">Login</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Formulário de cadastro serviço e prestador -->
  <main class="main-content container py-4">
    <h2 class="text-center mb-4">Cadastro de Serviço</h2>
    <form>
      <div class="row g-3">
        <!-- Dados do prestador -->
        <div class="col-md-6"><input type="text" class="form-control" placeholder="Nome completo" required></div>
        <div class="col-md-6"><input type="text" class="form-control" placeholder="CPF ou CNPJ" required></div>
        <div class="col-md-6"><input type="email" class="form-control" placeholder="Email" required></div>
        <div class="col-md-6 input-group">
          <input type="password" class="form-control" placeholder="Senha" required>
        </div>
        <div class="col-md-4"><input type="text" class="form-control" placeholder="CEP" required></div>
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Estado" required></div>
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Cidade" required></div>
        <div class="col-md-6"><input type="text" class="form-control" placeholder="Bairro" required></div>
        <div class="col-md-6"><input type="text" class="form-control" placeholder="Rua" required></div>
        <div class="col-md-6"><input type="text" class="form-control" placeholder="Telefone" required></div>
        <div class="col-md-6"><input type="date" class="form-control" required></div>

        <!-- Dados do serviço -->
        <div class="col-md-12">
          <input type="file" class="form-control" placeholder="Foto do serviço">
        </div>
        <div class="col-md-6">
          <select class="form-control" required>
            <option value="">Selecione a categoria</option>
            <?php while($categoria = $categorias->fetch_assoc()): ?>
                            <option value="<?= $categoria['ID'] ?>"><?= $categoria['Nome'] ?></option>
                        <?php endwhile; ?>
          </select>
        </div>
        <div class="col-md-6"><input type="text" class="form-control" placeholder="Preço (R$)" required></div>
        <div class="col-md-12"><textarea class="form-control" rows="4" placeholder="Descrição do serviço"
            required></textarea></div>
        <div class="col-md-12"><input type="text" class="form-control" placeholder="Horário de trabalho" required></div>
      </div>

      <div class="d-grid mt-4"><button type="submit" class="btn btn-login">Cadastrar Serviço</button></div>
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