<?php
session_start();
require '../config/ConexaoBanco.php';
require '../includes/valida_login.php';

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
    $idUsuario = $_SESSION["id_usuario"];
    $stmt->close();
    $database->closeConnection();
}
   