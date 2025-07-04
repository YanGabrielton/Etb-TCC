<?php

session_start();

// Verifica se as chaves 'email' e 'senha' existem no array $_POST
if (!isset($_POST["email"]) || !isset($_POST["senha"])) {
    $_SESSION['erro_login'] = 'Por favor, preencha todos os campos.';
    header("Location: /src/pages/login.php");
    exit;
}

require __DIR__ . '/../config/ConexaoBanco.php';

$database = new DataBase();
$conexao = $database->getConnection();

$email = $_POST["email"];
$senha = $_POST["senha"];

$sql = "
    SELECT u.ID, u.Nome, u.Foto, u.StatusUsuario, c.Email, c.Senha, na.Grupo 
    FROM Usuario u
    INNER JOIN Credencial c ON c.ID = u.FKCredencial
    INNER JOIN NivelAcesso na ON na.ID = c.FKNivelAcesso
    WHERE c.Email = ? AND u.StatusUsuario = 'ATIVO'
";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 1) {
    $registro = $resultado->fetch_assoc();
    
    if (password_verify($senha, $registro["Senha"])) {
        $_SESSION["id_usuario"] = $registro["ID"];
        $_SESSION["nome_usuario"] = $registro["Nome"];
        $_SESSION["foto_usuario"] = $registro["Foto"];
        $_SESSION["nivel_acesso"] = $registro["Grupo"];
        
        // Redirecionar conforme o nível de acesso
        switch ($registro["Grupo"]) {
            
            case "ADMINISTRADOR":
                header("Location: /src/pages/painel_adm.php");
                break;
            case "PRESTADOR":
                header("Location: /src/pages/perfil_prestador.php");
                break;
            case "CLIENTE":
                header("Location: /src/pages/perfil_usuario.php");
                break;
           
           
        }
        exit;
    } else {
        $_SESSION['erro_login'] = 'Senha incorreta!';
        header("Location: /src/pages/login.php");
        exit;
    }
} else {
    $_SESSION['erro_login'] = 'Usuário não encontrado ou inativo!';
    header("Location: /src/pages/login.php");
    exit;
}

$database->closeConnection();