// caso a pagina configurada atualmente não funciona aqui está a original


<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["id_usuario"])) {
    header("Location: cadastro_servico.php");
    exit;
}



include '../backend/config/ConexaoBanco.php';

$database = new DataBase();
$conexao = $database->getConnection();

// Buscar dados do usuário logado
$id_usuario = $_SESSION["id_usuario"];
$sql = "SELECT u.Nome, u.CPF, u.Celular, u.DataNascimento, 
               e.CEP, e.Estado, e.Cidade, e.Bairro, e.Rua,
               c.Email
        FROM Usuario u
        JOIN Credencial c ON u.FKCredencial = c.ID
        LEFT JOIN Endereco e ON u.FKEndereco = e.ID
        WHERE u.ID = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
$stmt->close();

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


  <!-- Formulário de cadastro serviço e prestador -->
  <main class="main-content container py-4">
    <h2 class="text-center mb-4">Cadastro de Serviço</h2>
    <form action="../backend/includes/processa_cadastra_servico.php" method="POST" enctype="multipart/form-data">
      <h4 class="mb-3">Dados Pessoais</h4>
      <div class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Nome completo" 
                   value="<?= htmlspecialchars($usuario['Nome'] ?? '') ?>" readonly style="background-color: #e9ecef;">
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="CPF" 
                   value="<?= htmlspecialchars($usuario['CPF'] ?? '') ?>" readonly style="background-color: #e9ecef;">
        </div>
        <div class="col-md-6">
            <input type="email" class="form-control" placeholder="Email" 
                   value="<?= htmlspecialchars($usuario['Email'] ?? '') ?>" readonly style="background-color: #e9ecef;">
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Telefone" 
                   value="<?= htmlspecialchars($usuario['Celular'] ?? '') ?>" readonly style="background-color: #e9ecef;">
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="CEP" 
                   value="<?= htmlspecialchars($usuario['CEP'] ?? '') ?>" readonly style="background-color: #e9ecef;">
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Estado" 
                   value="<?= htmlspecialchars($usuario['Estado'] ?? '') ?>" readonly style="background-color: #e9ecef;">
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Cidade" 
                   value="<?= htmlspecialchars($usuario['Cidade'] ?? '') ?>" readonly style="background-color: #e9ecef;">
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Bairro" 
                   value="<?= htmlspecialchars($usuario['Bairro'] ?? '') ?>" readonly style="background-color: #e9ecef;">
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Rua" 
                   value="<?= htmlspecialchars($usuario['Rua'] ?? '') ?>" readonly style="background-color: #e9ecef;">
        </div>
        <div class="col-md-6">
            <input type="date" class="form-control" 
                   value="<?= htmlspecialchars($usuario['DataNascimento'] ?? '') ?>" readonly style="background-color: #e9ecef;">
        </div>
      </div>

      <h4 class="mb-3">Dados do Serviço</h4>
      <div class="row g-3">
        <div class="col-md-12">
          <label for="foto" class="form-label">Foto do serviço (opcional)</label>
          <input type="file" class="form-control" id="foto" name="foto">
        </div>
        <div class="col-md-6">
          <select class="form-control" name="categoria" required>
            <option value="">Selecione a categoria</option>
            <?php while($categoria = $categorias->fetch_assoc()): ?>
                <option value="<?= $categoria['ID'] ?>"><?= $categoria['Nome'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-md-6">
            <input type="number" step="0.01" class="form-control" name="preco" placeholder="Preço (R$)" required>
        </div>
        <div class="col-md-12">
            <input type="text" class="form-control" name="titulo" placeholder="Título do serviço" required>
        </div>
        <div class="col-md-12">
            <textarea class="form-control" rows="4" name="descricao" placeholder="Descrição do serviço" required></textarea>
        </div>
        <!-- <div class="col-md-12">
            <input type="text" class="form-control" name="horario" placeholder="Horário de trabalho" required>
        </div> -->
      </div>

      <div class="d-grid mt-4">
          <button type="submit" class="btn btn-login">Cadastrar Serviço</button>
      </div>
    </form>
  </main>

  <!-- Footer -->
  <footer>
    <div class="container">
      <p>&copy; 2025 Job4You - Todos os direitos reservados.</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>