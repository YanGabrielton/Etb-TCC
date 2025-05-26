<?php
session_start();
require '../config/ConexaoBanco.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new DataBase();
    $conectar = $database->getConnection();

    $nome = $conectar->real_escape_string($_POST["nome"]);
    $cpf = $conectar->real_escape_string($_POST["cpf"]);
    $email = $conectar->real_escape_string($_POST["email"]);
    $senha = password_hash($_POST["senha"], PASSWORD_BCRYPT);
    $cep = $conectar->real_escape_string($_POST["cep"]);
    $estado = $conectar->real_escape_string($_POST["estado"]);
    $cidade = $conectar->real_escape_string($_POST["cidade"]);
    $bairro = $conectar->real_escape_string($_POST["bairro"]);
    $rua = $conectar->real_escape_string($_POST["rua"]);
    $telefone = $conectar->real_escape_string($_POST["telefone"]);
    $data_nascimento = $conectar->real_escape_string($_POST["data_nascimento"]);

    // Email duplicado?
    $verifica = $conectar->prepare("SELECT ID FROM Credencial WHERE Email = ?");
    $verifica->bind_param("s", $email);
    $verifica->execute();
    $resultado = $verifica->get_result();
    if ($resultado->num_rows > 0) {
        echo "<script>alert('E-mail já cadastrado!'); history.back();</script>";
        exit;
    }

    // Insere endereço
 // Insere endereço
$stmtEndereco = $conectar->prepare("INSERT INTO Endereco (CEP, Estado, Cidade, Bairro, Rua) VALUES (?, ?, ?, ?, ?)");
$stmtEndereco->bind_param("sssss", $cep, $estado, $cidade, $bairro, $rua);
if (!$stmtEndereco->execute()) {
    echo "Erro ao inserir endereço: " . $stmtEndereco->error;
    exit;
}
$idEndereco = $conectar->insert_id;
$stmtEndereco->close();

    // Insere credencial
    $fkNivelAcesso = 3; // CLIENTE inicialmente
    $stmtCredencial = $conectar->prepare("INSERT INTO Credencial (Email, Senha, FKNivelAcesso) VALUES (?, ?, ?)");
    $stmtCredencial->bind_param("ssi", $email, $senha, $fkNivelAcesso);
    $stmtCredencial->execute();
    $idCredencial = $conectar->insert_id;

    // Insere usuário
    $stmtUsuario = $conectar->prepare("INSERT INTO Usuario (Nome, CPF, Celular, DataNascimento, FKCredencial, FKEndereco) VALUES (?, ?, ?, ?, ?, ?)");
    $stmtUsuario->bind_param("ssssii", $nome, $cpf, $telefone, $data_nascimento, $idCredencial, $idEndereco);
    if ($stmtUsuario->execute()) {
        echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href='/index.php';</script>";
    } else {
        echo "Erro: " . $conectar->error;
    }

    $database->closeConnection();
}
?>
