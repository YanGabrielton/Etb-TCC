<?php
namespace App\Repositories\Usuarios;

use KissPhp\Abstractions\Repository;

class UsuariosRepository extends Repository {
    public function verificarEmailExistente(string $email): bool {
        $stmt = $this->conexao->prepare("SELECT ID FROM Credencial WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        
        return $resultado->num_rows > 0;
    }

    public function cadastrarEndereco(string $cep, string $estado, string $cidade, string $bairro, string $rua): int {
        $stmt = $this->conexao->prepare("INSERT INTO Endereco (CEP, Estado, Cidade, Bairro, Rua) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $cep, $estado, $cidade, $bairro, $rua);
        
        if (!$stmt->execute()) {
            throw new \Exception("Erro ao inserir endereço: " . $stmt->error);
        }
        
        $idEndereco = $this->conexao->insert_id;
        $stmt->close();
        
        return $idEndereco;
    }

    public function cadastrarCredencial(string $email, string $senha): int {
        $fkNivelAcesso = 3; // CLIENTE inicialmente
        $stmt = $this->conexao->prepare("INSERT INTO Credencial (Email, Senha, FKNivelAcesso) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $email, $senha, $fkNivelAcesso);
        
        if (!$stmt->execute()) {
            throw new \Exception("Erro ao inserir credencial: " . $stmt->error);
        }
        
        $idCredencial = $this->conexao->insert_id;
        $stmt->close();
        
        return $idCredencial;
    }

    public function cadastrarUsuario(string $nome, string $cpf, string $telefone, string $dataNascimento, int $idCredencial, int $idEndereco): bool {
        $stmt = $this->conexao->prepare("
            INSERT INTO Usuario (Nome, CPF, Celular, DataNascimento, FKCredencial, FKEndereco) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->bind_param("ssssii", $nome, $cpf, $telefone, $dataNascimento, $idCredencial, $idEndereco);
        
        if (!$stmt->execute()) {
            throw new \Exception("Erro ao cadastrar usuário: " . $stmt->error);
        }
        
        $stmt->close();
        return true;
    }

    public function verificarTipoUsuario(int $idUsuario): string {
        $sql = "SELECT COUNT(*) AS qtd FROM PublicacaoServico WHERE FKUsuario = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        
        if ($resultado['qtd'] > 0) {
            $this->atualizarNivelAcesso($idUsuario, 2); // 2 = PRESTADOR
            return "PRESTADOR";
        }
        
        return "CLIENTE";
    }

    public function atualizarNivelAcesso(int $idUsuario, int $nivelAcesso): void {
        $sql = "UPDATE Credencial SET FKNivelAcesso = ? WHERE ID = (
            SELECT FKCredencial FROM Usuario WHERE ID = ?
        )";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("ii", $nivelAcesso, $idUsuario);
        
        if (!$stmt->execute()) {
            throw new \Exception("Erro ao atualizar nível de acesso: " . $stmt->error);
        }
        
        $stmt->close();
    }
} 