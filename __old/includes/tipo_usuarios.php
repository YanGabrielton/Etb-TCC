<?php
function verificaTipoUsuario($conexao, $idUsuario) {
    $sql = "SELECT COUNT(*) AS qtd FROM PublicacaoServico WHERE FKUsuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();
    
    if ($resultado['qtd'] > 0) {
        // Atualiza para prestador (ID = 2)
        $update = "UPDATE Credencial SET FKNivelAcesso = 2 WHERE ID = (
            SELECT FKCredencial FROM Usuario WHERE ID = ?
        )";
        $stmtUpdate = $conexao->prepare($update);
        $stmtUpdate->bind_param("i", $idUsuario);
        $stmtUpdate->execute();
        return "PRESTADOR";
    } else {
        return "CLIENTE";
    }
}
?>
