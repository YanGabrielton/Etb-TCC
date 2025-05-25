<?php
include "../config/ConexaoBanco.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $telefone = $_POST["telefone"];
    
    // Padrão: cadastra como cliente (nivel 3)
    $sql = "INSERT INTO Credencial (Email, Senha, FKNivelAcesso)
            VALUES ('$email', '$senha', 3)";
    mysqli_query($conectar, $sql);
    $id_credencial = mysqli_insert_id($conectar);
    
    $sql = "INSERT INTO Usuario (Nome, CPF, Celular, FKCredencial)
            VALUES ('$nome', '$cpf', '$telefone', $id_credencial)";
    
    if(mysqli_query($conectar, $sql)) {
        echo "<script>
                alert('Cadastro realizado!');
                location.href='login.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao cadastrar!');
                history.back();
              </script>";
    }
}
?>