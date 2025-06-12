<?php
namespace App\Repositories\Autenticacao;

use App\Entities\Usuario;
use KissPhp\Abstractions\Repository;

class AutenticacaoRepository extends Repository {
  public function buscarUsuarioPorEmail(string $email): ?Usuario {
    try {
      $query = $this->database()
        ->createQueryBuilder()
        ->select('u.*')
        ->from('ViewUsuarioLogin', 'u')
        ->where('u.Email = :email')
        ->setParameter('email', $email)
        ->getQuery();

      $result = $query->execute()->fetchAssociative();
      if (!$result) return null;

      return $this->database()->getReference(Usuario::class, $result['ID']);
    } catch (\Throwable $th) {
      error_log("[Error] AutenticacaoRepository: {$th->getMessage()}");
      return null;
    }
  }

  public function cadastrarUsuario(): bool {
    return false;
  }  
}
