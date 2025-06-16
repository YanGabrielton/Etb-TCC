<?php
// includes/painel_admin.php

// Iniciar sessão e verificar se o usuário está logado e é um administrador
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: /src/pages/login.php');
    exit;
}

if ($_SESSION['nivel_acesso'] !== 'ADMINISTRADOR') {
    header('Location: /src/pages/login.php?error=acesso_negado');
    $_SESSION['error_message'] = 'Acesso negado. Você não tem permissão para acessar esta página.';
    exit;
}

include '../backend/config/ConexaoBanco.php';

$database = new DataBase();
$conexao = $database->getConnection();

// Função para buscar dados do usuário admin
function buscarUsuarioAdmin($conexao, $id) {
    $sql = "SELECT u.ID, u.Nome, u.Foto, u.CPF, u.Celular, u.DataNascimento, u.StatusUsuario, c.Email 
            FROM Usuario u
            INNER JOIN Credencial c ON c.ID = u.FKCredencial
            WHERE u.ID = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Buscar dados do usuário admin
$usuario = buscarUsuarioAdmin($conexao, $_SESSION['id_usuario']);

// Função para contar usuários
function contarUsuarios($conexao) {
    $sql = "SELECT COUNT(*) as total FROM Usuario WHERE StatusUsuario = 'ATIVO'";
    $result = $conexao->query($sql);
    return $result->fetch_assoc()['total'];
}

// Função para contar prestadores
function contarPrestadores($conexao) {
    $sql = "SELECT COUNT(DISTINCT u.ID) as total 
            FROM Usuario u 
            INNER JOIN Credencial c ON c.ID = u.FKCredencial 
            INNER JOIN NivelAcesso na ON na.ID = c.FKNivelAcesso 
            WHERE na.Grupo = 'PRESTADOR' AND u.StatusUsuario = 'ATIVO'";
    $result = $conexao->query($sql);
    return $result->fetch_assoc()['total'];
}

// Função para contar serviços ativos
function contarServicosAtivos($conexao) {
    $sql = "SELECT COUNT(*) as total FROM PublicacaoServico WHERE StatusPublicacao = 'ATIVO'";
    $result = $conexao->query($sql);
    return $result->fetch_assoc()['total'];
}

// Função para buscar atividades recentes
function buscarAtividadesRecentes($conexao) {
    $atividades = [];
    
    // Últimos usuários cadastrados
    $sql = "SELECT ID, Nome, DataCriacao as data, 'usuario' as tipo FROM Usuario 
            WHERE StatusUsuario = 'ATIVO' 
            ORDER BY DataCriacao DESC LIMIT 5";
    $result = $conexao->query($sql);
    while ($row = $result->fetch_assoc()) {
        $atividades[] = [
            'mensagem' => 'Novo usuário cadastrado: ' . $row['Nome'],
            'data' => $row['data'],
            'tipo' => $row['tipo'],
            'icone' => 'fa-user-plus'
        ];
    }
    
    // Últimos serviços cadastrados
    $sql = "SELECT p.ID, p.Titulo, p.DataCriacao as data, u.Nome, 'servico' as tipo
            FROM PublicacaoServico p
            INNER JOIN Usuario u ON u.ID = p.FKUsuario
            WHERE p.StatusPublicacao = 'ATIVO'
            ORDER BY p.DataCriacao DESC LIMIT 5";
    $result = $conexao->query($sql);
    while ($row = $result->fetch_assoc()) {
        $atividades[] = [
            'mensagem' => 'Novo serviço cadastrado: ' . $row['Titulo'] . ' por ' . $row['Nome'],
            'data' => $row['data'],
            'tipo' => $row['tipo'],
            'icone' => 'fa-briefcase'
        ];
    }
    
    // Ordenar todas as atividades por data
    usort($atividades, function($a, $b) {
        return strtotime($b['data']) - strtotime($a['data']);
    });
    
    return array_slice($atividades, 0, 10);
}

// Função para buscar todos os usuários
function buscarTodosUsuarios($conexao) {
    $sql = "SELECT u.ID, u.Nome, u.Foto, u.CPF, u.Celular, u.StatusUsuario, c.Email 
            FROM Usuario u
            INNER JOIN Credencial c ON c.ID = u.FKCredencial
            ORDER BY u.DataCriacao DESC";
    $result = $conexao->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Função para buscar todos os prestadores
function buscarTodosPrestadores($conexao) {
    $sql = "SELECT 
                u.ID, 
                u.Nome, 
                u.Foto, 
                u.StatusUsuario, 
                c.Email,
                COUNT(DISTINCT p.ID) as total_servicos,
                COALESCE(SUM(p.Valor), 0) as faturamento,
                COALESCE(AVG(a.Nota), 0) as avaliacao,
                COUNT(DISTINCT a.ID) as total_avaliacoes
            FROM Usuario u
            INNER JOIN Credencial c ON c.ID = u.FKCredencial
            INNER JOIN NivelAcesso na ON na.ID = c.FKNivelAcesso
            LEFT JOIN PublicacaoServico p ON p.FKUsuario = u.ID AND p.StatusPublicacao = 'ATIVO'
            LEFT JOIN AvaliacaoServico a ON a.FkPublicacao = p.ID
            WHERE na.Grupo = 'PRESTADOR'
            GROUP BY u.ID, u.Nome, u.Foto, u.StatusUsuario, c.Email
            ORDER BY u.DataCriacao DESC";
    $result = $conexao->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Função para buscar todos os serviços
function buscarTodosServicos($conexao) {
    $sql = "SELECT 
                p.ID, 
                p.Titulo, 
                p.Sobre, 
                p.Valor, 
                p.QuantidadeFavorito, 
                p.StatusPublicacao,
                u.Nome as prestador, 
                u.Foto as prestador_foto,
                cs.Nome as categoria
            FROM PublicacaoServico p
            INNER JOIN Usuario u ON u.ID = p.FKUsuario
            INNER JOIN CategoriaServico cs ON cs.ID = p.FKCategoria
            ORDER BY p.DataCriacao DESC";
    $result = $conexao->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Buscar todos os dados necessários
$total_usuarios = contarUsuarios($conexao);
$total_prestadores = contarPrestadores($conexao);
$total_servicos = contarServicosAtivos($conexao);
$atividades = buscarAtividadesRecentes($conexao);
$usuarios = buscarTodosUsuarios($conexao);
$prestadores = buscarTodosPrestadores($conexao);
$servicos = buscarTodosServicos($conexao);

$database->closeConnection();
