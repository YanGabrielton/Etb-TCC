<?php
namespace App\Repositories\Credenciais;

use KissPhp\Abstractions\Repository;

use App\Entities\Usuarios\{ Usuario, Credencial };

class CredencialRepository extends Repository {
  public function verificarEmailExistente(string $email): bool {
    try {
      return $this->buscarPorEmail($email) !== null;
    } catch (\Throwable $th) {
      error_log("[Error] CredencialRepository::verificarEmailExistente: {$th->getMessage()}");
      throw new \Exception("Erro ao verificar email existente");
    }
  }

  public function cadastrar(string $email, string $senha): int {
    try {
      $query = $this->database()
        ->getConnection()
        ->createQueryBuilder()
        ->insert('Credencial')
        ->values([
          'Email' => ':email',
          'Senha' => ':senha',
          'FKNivelAcesso' => ':nivelAcesso'
        ])
        ->setParameter('email', $email)
        ->setParameter('senha', $senha)
        ->setParameter('nivelAcesso', 3); // CLIENTE

      $query->executeQuery();
      return (int) $this->database()->getConnection()->lastInsertId();
    } catch (\Throwable $th) {
      error_log("[Error] CredencialRepository::cadastrar: {$th->getMessage()}");
      throw new \Exception("Erro ao cadastrar credencial");
    }
  }

  public function atualizarNivelAcesso(int $idUsuario, int $nivelAcesso): void {
    try {
      $query = $this->database()->getConnection()
        ->createQueryBuilder()
        ->update('Credencial')
        ->set('FKNivelAcesso', ':nivelAcesso')
        ->where('ID = (SELECT FKCredencial FROM Usuario WHERE ID = :idUsuario)')
        ->setParameter('nivelAcesso', $nivelAcesso)
        ->setParameter('idUsuario', $idUsuario);

      $query->executeQuery();
    } catch (\Throwable $th) {
      error_log("[Error] CredencialRepository::atualizarNivelAcesso: {$th->getMessage()}");
      throw new \Exception("Erro ao atualizar nível de acesso");
    }
  }

  public function buscarPorEmail(string $email): ?Credencial {
    try {
      $credencial = $this->database()
        ->getRepository(Credencial::class)
        ->findOneBy(['email' => $email]);

      return $credencial;
    } catch (\Throwable $th) {
      error_log("[Error] AutenticacaoRepository: {$th->getMessage()}");
      return null;
    }
  }

  public function buscarPorId(float $id): ?Credencial {
    try {
      $credencial = $this->database()
        ->getRepository(Credencial::class)
        ->findOneBy(['id' => $id]);

      return $credencial;
    } catch (\Throwable $th) {
      error_log("[Error] AutenticacaoRepository: {$th->getMessage()}");
      return null;
    }
  }
} 