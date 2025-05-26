<?php
session_start();
require '../config/ConexaoBanco.php';
require '../backend/includes/valida_login.php';

$database = new DataBase();
$conectar = $database->getConnection();

// Busca categorias para o select
$sql_categorias = "SELECT ID, Nome FROM CategoriaServico";
$categorias = $conectar->query($sql_categorias);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do serviço
    $titulo = $conectar->real_escape_string($_POST["titulo"]);
    $descricao = $conectar->real_escape_string($_POST["descricao"]);
    $preco = $conectar->real_escape_string($_POST["preco"]);
    $categoria = $conectar->real_escape_string($_POST["categoria"]);
    $horario = $conectar->real_escape_string($_POST["horario"]);
    $id_usuario = $_SESSION["id_usuario"];

    // Upload da imagem
    $foto_nome = null;
    if (!empty($_FILES["foto"]["name"])) {
        $ext = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
        $foto_nome = "img/servicos/" . uniqid() . "." . $ext;
        $caminho_absoluto = $_SERVER["DOCUMENT_ROOT"] . "/src/" . $foto_nome;
        
        if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $caminho_absoluto)) {
            echo "<script>alert('Erro ao enviar imagem!'); history.back();</script>";
            exit;
        }
    }

    // Insere serviço
    $stmt = $conectar->prepare("INSERT INTO PublicacaoServico 
                              (Titulo, Sobre, Valor, FKCategoria, FKUsuario, StatusPublicacao) 
                              VALUES (?, ?, ?, ?, ?, 'EM_ANALISE')");
    $stmt->bind_param("ssdii", $titulo, $descricao, $preco, $categoria, $id_usuario);
    
    if ($stmt->execute()) {
        echo "<script>
                alert('Serviço cadastrado com sucesso! Aguarde aprovação.');
                window.location.href = '../servicos/buscar.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao cadastrar serviço: " . addslashes($conectar->error) . "');
                history.back();
              </script>";
    }
    
    $stmt->close();
    $database->closeConnection();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job4You - Cadastrar Serviço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/css/global.css">
</head>
<body>
    <!-- Navbar atualizado para PHP -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
        <a class="navbar-brand fw-bold" href="../index.php">Job4You</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Sobre</a>
                </li>
                <?php if(isset($_SESSION["id_usuario"])): ?>
                    <li class="nav-item mx-2">
                        <a class="btn btn-login" href="../logout.php">Sair</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Formulário de cadastro -->
    <main class="main-content container py-4">
        <h2 class="text-center mb-4">Cadastro de Serviço</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row g-3">
                <!-- Dados do serviço -->
                <div class="col-md-12">
                    <input type="file" class="form-control" name="foto" accept="image/*">
                </div>
                <div class="col-md-6">
                    <select class="form-control" name="categoria" required>
                        <option value="">Selecione a categoria</option>
                        <?php while($cat = $categorias->fetch_assoc()): ?>
                            <option value="<?= $cat['ID'] ?>"><?= $cat['Nome'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="preco" placeholder="Preço (R$)" required>
                </div>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="titulo" placeholder="Título do serviço" required>
                </div>
                <div class="col-md-12">
                    <textarea class="form-control" rows="4" name="descricao" placeholder="Descrição detalhada" required></textarea>
                </div>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="horario" placeholder="Horário de atendimento" required>
                </div>
            </div>
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-login">Cadastrar Serviço</button>
            </div>
        </form>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Job4You - Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
<?php $database->closeConnection(); ?>