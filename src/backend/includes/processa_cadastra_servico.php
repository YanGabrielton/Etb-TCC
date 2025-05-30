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
$titulo = $_POST["titulo"];
$descricao = $_POST["descricao"];
$valor = $_POST["preco"];
$categoria = $_POST["categoria"];
$data_criacao = date("Y-m-d H:i:s");
$status = 'ATIVO';

// Upload da imagem (opcional)
$foto = null;
if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
    $nomeArquivo = basename($_FILES["foto"]["name"]);
    $caminhoDestino = "../../uploads/" . $nomeArquivo;

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminhoDestino)) {
        $foto = $nomeArquivo;

        // Atualizar a foto na tabela Usuario
        $updateFotoUsuario = $conexao->prepare("UPDATE Usuario SET Foto = ? WHERE ID = ?");
        $updateFotoUsuario->bind_param("si", $foto, $id_usuario);
        $updateFotoUsuario->execute();
        $updateFotoUsuario->close();
    }
}

// Inserir o serviço na tabela PublicacaoServico (sem o campo Foto)
$stmt = $conexao->prepare("INSERT INTO PublicacaoServico 
    (FKUsuario, Titulo, Sobre, Valor, FKCategoria, StatusPublicacao, DataCriacao)
    VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issdsss", $id_usuario, $titulo, $descricao, $valor, $categoria, $status, $data_criacao);

if ($stmt->execute()) {
    // Verificar se o usuário tem serviços ativos
    $verifica = $conexao->prepare("SELECT COUNT(*) AS total FROM PublicacaoServico WHERE FKUsuario = ? AND StatusPublicacao = 'ATIVO'");
    $verifica->bind_param("i", $id_usuario);
    $verifica->execute();
    $res = $verifica->get_result()->fetch_assoc();
    $verifica->close();

    if ($res['total'] > 0) {
        // Buscar a credencial do usuário
        $buscaCredencial = $conexao->prepare("SELECT FKCredencial FROM Usuario WHERE ID = ?");
        $buscaCredencial->bind_param("i", $id_usuario);
        $buscaCredencial->execute();
        $resultado = $buscaCredencial->get_result()->fetch_assoc();
        $buscaCredencial->close();

        $fk_credencial = $resultado['FKCredencial'];

        // Buscar o ID do nível de acesso 'PRESTADOR'
        $buscaNivel = $conexao->prepare("SELECT ID FROM NivelAcesso WHERE Grupo = 'PRESTADOR'");
        $buscaNivel->execute();
        $idNivel = $buscaNivel->get_result()->fetch_assoc();
        $buscaNivel->close();

        $id_prestador = $idNivel['ID'];

        // Atualizar o nível de acesso na tabela Credencial
        $atualizaNivel = $conexao->prepare("UPDATE Credencial SET FKNivelAcesso = ? WHERE ID = ?");
        $atualizaNivel->bind_param("ii", $id_prestador, $fk_credencial);
        $atualizaNivel->execute();
        $atualizaNivel->close();
    }

    header("Location: /src/pages/prestadores.php?sucesso=1");
    exit;
} else {
    echo "Erro ao cadastrar serviço: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>
