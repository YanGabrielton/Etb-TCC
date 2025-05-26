<?php
session_start();
require '../config/ConexaoBanco.php';
require '../backend/funcoes.php';
require '../backend/valida_login.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $sobre = $_POST["sobre"];
    $valor = $_POST["valor"];
    $categoria = $_POST["categoria"];
    $usuarioID = $_SESSION["id_usuario"];

    $db = new DataBase();
    $conexao = $db->getConnection();

    $stmt = $conexao->prepare("INSERT INTO PublicacaoServico (Titulo, Sobre, Valor, FKCategoria, FKUsuario) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdii", $titulo, $sobre, $valor, $categoria, $usuarioID);
    if ($stmt->execute()) {
        // Atualiza tipo automaticamente
        verificaTipoUsuario($conexao, $usuarioID);

        echo "<script>alert('Serviço cadastrado com sucesso!'); window.location.href='../pages/index.php';</script>";
    } else {
        echo "Erro ao cadastrar serviço: " . $conexao->error;
    }
}
?>
