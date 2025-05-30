<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../pages/login.php");
    exit;
}

include '../config/ConexaoBanco.php';

$database = new DataBase();
$conexao = $database->getConnection();

$id_usuario = $_SESSION["id_usuario"];
$id_servico = $_GET["id"] ?? null;

if ($id_servico === null) {
    header("Location: ../../src/pages/minha_conta.php?erro=1");
    exit;
}

// Desativa o serviço
$cancelar = $conexao->prepare("UPDATE PublicacaoServico SET StatusPublicacao = 'INATIVO' WHERE ID = ? AND FKUsuario = ?");
$cancelar->bind_param("ii", $id_servico, $id_usuario);
$cancelar->execute();
$cancelar->close();

// Verifica quantos serviços ativos restaram
$verifica = $conexao->prepare("SELECT COUNT(*) AS total FROM PublicacaoServico WHERE FKUsuario = ? AND StatusPublicacao = 'ATIVO'");
$verifica->bind_param("i", $id_usuario);
$verifica->execute();
$res = $verifica->get_result()->fetch_assoc();
$verifica->close();

// Se não restar nenhum, volta a ser CLIENTE
if ($res['total'] == 0) {
    $voltaCliente = $conexao->prepare("UPDATE Usuario SET NivelAcesso = 'CLIENTE' WHERE ID = ?");
    $voltaCliente->bind_param("i", $id_usuario);
    $voltaCliente->execute();
    $voltaCliente->close();
}

header("Location: /src/pages/prestadores.php?sucesso=1");
exit;
