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
    $sql = "SELECT ID, Nome FROM CategoriaServico";

    $resultado = $this->conexao->query($sql);
    $categorias = [];

    while ($row = $resultado->fetch_assoc()) {
      $categorias[] = new Categoria((int) $row['ID'], $row['Nome']);
    }
    return $categorias;
  }

  public function buscarServicos(): array {
    $sql = "SELECT ps.Titulo, ps.Sobre, ps.Valor, u.Nome, cs.Nome AS Categoria
            FROM PublicacaoServico ps
            JOIN Usuario u ON ps.FKUsuario = u.ID
            JOIN CategoriaServico cs ON ps.FKCategoria = cs.ID
            WHERE ps.StatusPublicacao = 'ATIVO'";
            
    $resultado = $this->conexao->query($sql);
    $servicos = [];

    while ($row = $resultado->fetch_assoc()) $servicos[] = $row;
    return $servicos;
  }

  public function cadastrarServico(CadastroServico $dto): bool {
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
  }

  private function atualizarNivelAcesso(int $idUsuario): void {
    // Verificar se o usuário tem serviços ativos
    $verifica = $this->conexao->prepare("SELECT COUNT(*) AS total FROM PublicacaoServico WHERE FKUsuario = ? AND StatusPublicacao = 'ATIVO'");
    $verifica->bind_param("i", $idUsuario);
    $verifica->execute();
    $res = $verifica->get_result()->fetch_assoc();
    $verifica->close();

    if ($res['total'] > 0) {
      // Buscar a credencial do usuário
      $buscaCredencial = $this->conexao->prepare("SELECT FKCredencial FROM Usuario WHERE ID = ?");
      $buscaCredencial->bind_param("i", $idUsuario);
      $buscaCredencial->execute();
      $resultado = $buscaCredencial->get_result()->fetch_assoc();
      $buscaCredencial->close();

      $fk_credencial = $resultado['FKCredencial'];

      // Buscar o ID do nível de acesso 'PRESTADOR'
      $buscaNivel = $this->conexao->prepare("SELECT ID FROM NivelAcesso WHERE Grupo = 'PRESTADOR'");
      $buscaNivel->execute();
      $idNivel = $buscaNivel->get_result()->fetch_assoc();
      $buscaNivel->close();

      $id_prestador = $idNivel['ID'];

      // Atualizar o nível de acesso na tabela Credencial
      $atualizaNivel = $this->conexao->prepare("UPDATE Credencial SET FKNivelAcesso = ? WHERE ID = ?");
      $atualizaNivel->bind_param("ii", $id_prestador, $fk_credencial);
      $atualizaNivel->execute();
      $atualizaNivel->close();
    }
  }

  public function desativarServico(int $idServico, int $idUsuario): bool {
    // Desativa o serviço
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
  }

  private function verificarNivelAcesso(int $idUsuario): void {
    // Verifica quantos serviços ativos restaram
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
    if ($res['total'] == 0) {
      // Buscar a credencial do usuário
      $buscaCredencial = $this->conexao->prepare("SELECT FKCredencial FROM Usuario WHERE ID = ?");
      $buscaCredencial->bind_param("i", $idUsuario);
      $buscaCredencial->execute();
      $resultado = $buscaCredencial->get_result()->fetch_assoc();
      $buscaCredencial->close();

      $fk_credencial = $resultado['FKCredencial'];

      // Buscar o ID do nível de acesso 'CLIENTE'
      $buscaNivel = $this->conexao->prepare("SELECT ID FROM NivelAcesso WHERE Grupo = 'CLIENTE'");
      $buscaNivel->execute();
      $idNivel = $buscaNivel->get_result()->fetch_assoc();
      $buscaNivel->close();

      $id_cliente = $idNivel['ID'];

      // Atualizar o nível de acesso na tabela Credencial
      $atualizaNivel = $this->conexao->prepare("UPDATE Credencial SET FKNivelAcesso = ? WHERE ID = ?");
      $atualizaNivel->bind_param("ii", $id_cliente, $fk_credencial);
      $atualizaNivel->execute();
      $atualizaNivel->close();
    }
  }
}