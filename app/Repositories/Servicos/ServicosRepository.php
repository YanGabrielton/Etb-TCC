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
    $sql = "SELECT * FROM ViewPublicacao";
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
    return true;
  }
}