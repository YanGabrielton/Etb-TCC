<?php
session_start();
if(isset($_SESSION["nome_usuario"])) {
    header("Location: ../index.php");
    exit;
}
require '../config/DataBase.php';
include "../../includes/conexao.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT u.ID, u.Nome, u.Foto, c.Senha, na.Grupo 
            FROM Usuario u
            JOIN Credencial c ON c.ID = u.FKCredencial
            JOIN NivelAcesso na ON na.ID = c.FKNivelAcesso
            WHERE c.Email = '$email' AND u.StatusUsuario = 'ATIVO'";

    $resultado = mysqli_query($conectar, $sql);

    if(mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        
        if($senha == $usuario["Senha"]) { // Comparação direta como no exemplo
            $_SESSION["id_usuario"] = $usuario["ID"];
            $_SESSION["nome_usuario"] = $usuario["Nome"];
            $_SESSION["foto_usuario"] = $usuario["Foto"];
            $_SESSION["nivel_acesso"] = $usuario["Grupo"];
            
            echo "<script>location.href='../index.php';</script>";
        } else {
            echo "<script>alert('Senha incorreta!'); history.back();</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!'); history.back();</script>";
    }
}
