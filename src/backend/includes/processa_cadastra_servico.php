<?php
session_start();
include '../config/ConexaoBanco.php';

// Verificar se o usuário está logado e é um prestador
if (!isset($_SESSION["id_usuario"]) || $_SESSION["nivel_acesso"] != "PRESTADOR") {
    header("Location: /index.php");
    exit;
}

$id_usuario = $_SESSION["id_usuario"];
$categoria = $_POST["categoria"];
$preco = $_POST["preco"];
$titulo = mysqli_real_escape_string($conexao, $_POST["titulo"]);
$sobre = mysqli_real_escape_string($conexao, $_POST["sobre"]);
$horario = mysqli_real_escape_string($conexao, $_POST["horario"]);

// Processar upload da foto
$foto_nome = "";
if (!empty($_FILES["foto"]["name"])) {
    $extensao = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $foto_nome = "servicos/" . uniqid() . "." . $extensao;
    move_uploaded_file($_FILES["foto"]["tmp_name"], "../uploads/" . $foto_nome);
}

$sql = "INSERT INTO PublicacaoServico (Titulo, Sobre, Valor, FKCategoria, FKUsuario, StatusPublicacao) 
        VALUES ('$titulo', '$sobre', $preco, $categoria, $id_usuario, 'EM_ANALISE')";

if (mysqli_query($conexao, $sql)) {
    echo "<script>alert('Serviço cadastrado com sucesso e está em análise!'); location.href='buscar_servicos.php';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar serviço!'); history.back();</script>";
}
?>