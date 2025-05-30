<?php
session_start();

// Corrigir o caminho para o arquivo se necessário
include '../config/ConexaoBanco.php'; // ou ajuste conforme sua estrutura de pastas

$database = new DataBase();
$conexao = $database->getConnection();

$email = mysqli_real_escape_string($conexao, $_POST["email"]);
$senha = $_POST["senha"];

$sql = "SELECT u.ID, u.Nome, u.Foto, u.StatusUsuario, c.Email, c.Senha, na.Grupo 
        FROM Usuario u
        INNER JOIN Credencial c ON c.ID = u.FKCredencial
        INNER JOIN NivelAcesso na ON na.ID = c.FKNivelAcesso
        WHERE c.Email = '$email' AND u.StatusUsuario = 'ATIVO'";

$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) == 1) {
    $registro = mysqli_fetch_assoc($resultado);
    
    // Verificar senha (usando password_verify para senhas criptografadas)
    if (password_verify($senha, $registro["Senha"])) {
        $_SESSION["id_usuario"] = $registro["ID"];
        $_SESSION["nome_usuario"] = $registro["Nome"];
        $_SESSION["foto_usuario"] = $registro["Foto"];
        $_SESSION["nivel_acesso"] = $registro["Grupo"];
        
        $id = $registro["ID"]; // capturando o ID
        
        // Redirecionar conforme o nível de acesso
    switch ($registro["Grupo"]) {
    case "ADMINISTRADOR":
        header("Location: ../admin/admin.php?id_usuario=$id");
        break;
    case "PRESTADOR":
        header("Location: ../servicos/buscar_servicos.php?id_usuario=$id");
        break;
    case "CLIENTE":
        header("Location: /index.php?id_usuario=$id");
        break;
    default:
        header("Location: /index.php?id_usuario=$id");
}
        exit;
    } else {
        echo "<script>alert('Senha incorreta!'); history.back();</script>";
    }
} else {
    echo "<script>alert('Usuário não encontrado ou inativo!'); history.back();</script>";
}

$database->closeConnection();
?>
