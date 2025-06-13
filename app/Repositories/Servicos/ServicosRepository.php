<?php
namespace App\Repositories\Servicos;

use App\Utils\DatabaseConnection;
use App\DTOs\Servicos\{ Categoria, CadastroServico };

class ServicosRepository {
  private $database;
  private $conexao;

  public function __construct() {
    $this->database = new DatabaseConnection();
    $this->conexao = $this->database->getConnection();
  }

  /** @return Categoria[] */
  public function buscarCategorias(): array {
    try {
      $sql = "SELECT ID, Nome FROM CategoriaServico";
      $resultado = $this->conexao->query($sql);
      $categorias = [];

      while ($row = $resultado->fetch_assoc()) {
        $categorias[] = new Categoria((int) $row['ID'], $row['Nome']);
      }
      return $categorias;
    } catch (\Throwable $th) {
      error_log("[Error] ServicosRepository::buscarCategorias: {$th->getMessage()}");
      throw new \Exception("Erro ao buscar categorias");
    }
  }

  public function buscarServicos(): array {
    try {
      $sql = "SELECT ps.Titulo, ps.Sobre, ps.Valor, u.Nome, cs.Nome AS Categoria
              FROM PublicacaoServico ps
              JOIN Usuario u ON ps.FKUsuario = u.ID
              JOIN CategoriaServico cs ON ps.FKCategoria = cs.ID
              WHERE ps.StatusPublicacao = 'ATIVO'";
              
      $resultado = $this->conexao->query($sql);
      $servicos = [];

      while ($row = $resultado->fetch_assoc()) {
        $servicos[] = $row;
      }
      return $servicos;
    } catch (\Throwable $th) {
      error_log("[Error] ServicosRepository::buscarServicos: {$th->getMessage()}");
      throw new \Exception("Erro ao buscar serviços");
    }
  }

  public function cadastrarServico(CadastroServico $dto): bool {
    try {
      $stmt = $this->conexao->prepare("
        INSERT INTO PublicacaoServico 
        (Titulo, Sobre, Valor, FKCategoria, FKUsuario, StatusPublicacao, Foto) 
        VALUES (?, ?, ?, ?, ?, 'EM_ANALISE', ?)
      ");
      
      $stmt->bind_param(
        "ssdiis",
        $dto->titulo,
        $dto->descricao,
        $dto->preco,
        $dto->categoriaServico,
        $dto->idUsuario,
        $dto->fotoNome
      );
      
      if (!$stmt->execute()) {
        throw new \Exception("Erro ao cadastrar serviço: " . $this->conexao->error);
      }
      
      $stmt->close();
      
      // Verifica se precisa atualizar o nível de acesso
      $this->atualizarNivelAcesso($dto->idUsuario);
      
      return true;
    } catch (\Throwable $th) {
      error_log("[Error] ServicosRepository::cadastrarServico: {$th->getMessage()}");
      throw new \Exception("Erro ao cadastrar serviço");
    }
  }

  public function desativarServico(int $idServico, int $idUsuario): bool {
    try {
      $stmt = $this->conexao->prepare("
        UPDATE PublicacaoServico 
        SET StatusPublicacao = 'INATIVO' 
        WHERE ID = ? AND FKUsuario = ?
      ");
      
      $stmt->bind_param("ii", $idServico, $idUsuario);
      
      if (!$stmt->execute()) {
        throw new \Exception("Erro ao desativar serviço: " . $stmt->error);
      }
      
      $stmt->close();
      
      // Verifica se precisa voltar para CLIENTE
      $this->verificarNivelAcesso($idUsuario);
      
      return true;
    } catch (\Throwable $th) {
      error_log("[Error] ServicosRepository::desativarServico: {$th->getMessage()}");
      throw new \Exception("Erro ao desativar serviço");
    }
  }

  private function verificarNivelAcesso(int $idUsuario): void {
    try {
      $verifica = $this->conexao->prepare("
        SELECT COUNT(*) AS total 
        FROM PublicacaoServico 
        WHERE FKUsuario = ? AND StatusPublicacao = 'ATIVO'
      ");
      
      $verifica->bind_param("i", $idUsuario);
      $verifica->execute();
      $res = $verifica->get_result()->fetch_assoc();
      $verifica->close();

      // Se não restar nenhum, volta a ser CLIENTE
      if ($res['total'] === 0) {
        $atualiza = $this->conexao->prepare("
          UPDATE Credencial 
          SET FKNivelAcesso = 3 
          WHERE ID = (SELECT FKCredencial FROM Usuario WHERE ID = ?)
        ");
        
        $atualiza->bind_param("i", $idUsuario);
        $atualiza->execute();
        $atualiza->close();
      }
    } catch (\Throwable $th) {
      error_log("[Error] ServicosRepository::verificarNivelAcesso: {$th->getMessage()}");
      throw new \Exception("Erro ao verificar nível de acesso");
    }
  }

  private function atualizarNivelAcesso(int $idUsuario): void {
    try {
      $stmt = $this->conexao->prepare("
        UPDATE Credencial 
        SET FKNivelAcesso = 2 
        WHERE ID = (SELECT FKCredencial FROM Usuario WHERE ID = ?)
      ");
      
      $stmt->bind_param("i", $idUsuario);
      $stmt->execute();
      $stmt->close();
    } catch (\Throwable $th) {
      error_log("[Error] ServicosRepository::atualizarNivelAcesso: {$th->getMessage()}");
      throw new \Exception("Erro ao atualizar nível de acesso");
    }
  }
}