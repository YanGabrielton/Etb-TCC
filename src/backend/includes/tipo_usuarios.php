<?php
function verificaTipoUsuario($conectar, $id_usuario) {
    // Verifica se é admin
    $sql = "SELECT na.Grupo FROM Usuario u
            JOIN Credencial c ON c.ID = u.FKCredencial
            JOIN NivelAcesso na ON na.ID = c.FKNivelAcesso
            WHERE u.ID = $id_usuario";
    $resultado = mysqli_query($conectar, $sql);
    $tipo = mysqli_fetch_row($resultado)[0];
    
    // Se não for admin, verifica se tem serviços cadastrados
    if($tipo == "CLIENTE") {
        $sql = "SELECT COUNT(*) FROM PublicacaoServico 
                WHERE FKUsuario = $id_usuario";
        $resultado = mysqli_query($conectar, $sql);
        $num_servicos = mysqli_fetch_row($resultado)[0];
        
        if($num_servicos > 0) {
            // Atualiza para prestador
            $sql = "UPDATE Credencial c
                    JOIN Usuario u ON u.FKCredencial = c.ID
                    SET c.FKNivelAcesso = 2
                    WHERE u.ID = $id_usuario";
            mysqli_query($conectar, $sql);
            return "PRESTADOR";
        }
    }
    
    return $tipo;
}
?>