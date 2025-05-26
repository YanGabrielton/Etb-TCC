<?php
session_start();
include '../config/ConexaoBanco.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new DataBase();
    $conectar = $database->getConnection();
    
    $email = $conectar->real_escape_string($_POST["email"]);
    $senha = $_POST["senha"];

    $sql = "SELECT u.ID, u.Nome, u.Foto, c.Senha, na.Grupo 
            FROM Usuario u
            JOIN Credencial c ON c.ID = u.FKCredencial
            JOIN NivelAcesso na ON na.ID = c.FKNivelAcesso
            WHERE c.Email = '$email' AND u.StatusUsuario = 'ATIVO'";

    $resultado = $conectar->query($sql);

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        
        if ($senha == $usuario["Senha"]) {
            $_SESSION["id_usuario"] = $usuario["ID"];
            $_SESSION["nome_usuario"] = $usuario["Nome"];
            $_SESSION["foto_usuario"] = $usuario["Foto"];
            $_SESSION["nivel_acesso"] = $usuario["Grupo"];
            
            // Verifica e atualiza tipo de usuário se necessário
            include_once '../backend/includes/tipo_usuarios.php';
            $_SESSION["nivel_acesso"] = verificaTipoUsuario($conectar, $_SESSION["id_usuario"]);
            
            header("Location: ../index.php");
            exit;
        } else {
            echo "<script>alert('Senha incorreta!'); history.back();</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!'); history.back();</script>";
    }
    $database->closeConnection();
}
?>
