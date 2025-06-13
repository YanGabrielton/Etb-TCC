<?php
namespace App\Repositories\Usuarios;

use App\Entities\Usuario;
use KissPhp\Abstractions\Repository;

class UsuariosRepository extends Repository {
  public function cadastrar(Usuario $usuario): int {
    try {
      $this->database()->persist($usuario);
      $this->database()->flush();

      return $this->database()->getConnection()->lastInsertId();
    } catch (\Throwable $th) {
      error_log("[Error] UsuariosRepository::cadastrar: {$th->getMessage()}");
      throw new \Exception("Erro ao cadastrar usuário");
    }
  }

  private function verificarNivelAcesso(int $idUsuario): void {
    try {
      $qb = $this->database()->getConnection()->createQueryBuilder();
      
      $resultado = $qb->select('COUNT(*) AS total')
        ->from('PublicacaoServico')
        ->where('FKUsuario = :idUsuario')
        ->andWhere('StatusPublicacao = :status')
        ->setParameters([
          'idUsuario' => $idUsuario,
          'status' => 'ATIVO'
        ])
        ->executeQuery()
        ->fetchAssociative();

      // Se não restar nenhum, volta a ser CLIENTE
      if ($resultado['total'] === 0) {
        $qb = $this->database()->getConnection()->createQueryBuilder();
        
        $qb->update('Credencial')
          ->set('FKNivelAcesso', ':nivel')
          ->where('ID = (SELECT FKCredencial FROM Usuario WHERE ID = :idUsuario)')
          ->setParameters([
            'nivel' => 3,
            'idUsuario' => $idUsuario
          ])
          ->executeStatement();
      }
    } catch (\Throwable $th) {
      error_log("[Error] ServicosRepository::verificarNivelAcesso: {$th->getMessage()}");
      throw new \Exception("Erro ao verificar nível de acesso");
    }
  }

  public function verificarTipoUsuario(int $idUsuario): string {
    try {
      $query = $this->database()->getConnection()
        ->createQueryBuilder()
        ->select('COUNT(*) as qtd')
        ->from('PublicacaoServico', 'p')
        ->where('p.FKUsuario = :idUsuario')
        ->setParameter('idUsuario', $idUsuario);

      $result = $query->executeQuery()->fetchAssociative();

      if ($result['qtd'] > 0) return "PRESTADOR";

      return "CLIENTE";
    } catch (\Throwable $th) {
      error_log("[Error] UsuariosRepository::verificarTipoUsuario: {$th->getMessage()}");
      throw new \Exception("Erro ao verificar tipo de usuário");
    }
  }
}
