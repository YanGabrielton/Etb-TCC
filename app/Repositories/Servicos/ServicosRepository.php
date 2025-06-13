<?php
namespace App\Repositories\Servicos;

use KissPhp\Abstractions\Repository;

use App\Entities\CategoriaServico;
use App\DTOs\Servicos\{ Categoria, CadastroServico };

class ServicosRepository extends Repository {
  /** @return Categoria[] */
  public function buscarCategorias(): array {
    try {
      $qb = $this->database()->getConnection()->createQueryBuilder();
      
      $resultado = $qb->select('ID', 'Nome')
        ->from('CategoriaServico')
        ->executeQuery();
      
      $categorias = [];
      while ($row = $resultado->fetchAssociative()) {
        $categorias[] = new CategoriaServico((int) $row['ID'], $row['Nome']);
      }
      return $categorias;
    } catch (\Throwable $th) {
      error_log("[Error] ServicosRepository::buscarCategorias: {$th->getMessage()}");
      throw new \Exception("Erro ao buscar categorias");
    }
  }

  public function buscar(): array {
    try {
      $qb = $this->database()->getConnection()->createQueryBuilder();
      
      return $qb->select('ps.Titulo', 'ps.Sobre', 'ps.Valor', 'u.Nome', 'cs.Nome AS Categoria')
        ->from('PublicacaoServico', 'ps')
        ->innerJoin('ps', 'Usuario', 'u', 'ps.FKUsuario = u.ID')
        ->innerJoin('ps', 'CategoriaServico', 'cs', 'ps.FKCategoria = cs.ID')
        ->where('ps.StatusPublicacao = :status')
        ->setParameter('status', 'ATIVO')
        ->executeQuery()
        ->fetchAllAssociative();
    } catch (\Throwable $th) {
      error_log("[Error] ServicosRepository::buscarServicos: {$th->getMessage()}");
      throw new \Exception("Erro ao buscar serviços");
    }
  }

  public function cadastrar(CadastroServico $dto): bool {
    try {
      $qb = $this->database()->getConnection()->createQueryBuilder();
      
      $qb->insert('PublicacaoServico')
        ->values([
          'Titulo' => ':titulo',
          'Sobre' => ':descricao',
          'Valor' => ':preco',
          'FKCategoria' => ':categoriaServico',
          'FKUsuario' => ':idUsuario',
          'StatusPublicacao' => ':status',
          'Foto' => ':fotoNome'
        ])
        ->setParameters([
          'titulo' => $dto->titulo,
          'descricao' => $dto->descricao,
          'preco' => $dto->preco,
          'categoriaServico' => $dto->categoriaServico,
          'idUsuario' => $dto->idUsuario,
          'status' => 'EM_ANALISE',
          'fotoNome' => $dto->fotoNome
        ])
        ->executeStatement();
      
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
      $qb = $this->database()->getConnection()->createQueryBuilder();
      
      $qb->update('PublicacaoServico')
        ->set('StatusPublicacao', ':status')
        ->where('ID = :idServico')
        ->andWhere('FKUsuario = :idUsuario')
        ->setParameters([
          'status' => 'INATIVO',
          'idServico' => $idServico,
          'idUsuario' => $idUsuario
        ])
        ->executeStatement();
      
      // Verifica se precisa voltar para CLIENTE
      $this->verificarNivelAcesso($idUsuario);
      
      return true;
    } catch (\Throwable $th) {
      error_log("[Error] ServicosRepository::desativarServico: {$th->getMessage()}");
      throw new \Exception("Erro ao desativar serviço");
    }
  }
}