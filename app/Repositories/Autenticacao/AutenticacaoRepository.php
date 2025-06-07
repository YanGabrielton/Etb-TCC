<?php
namespace App\Repositories\Autenticacao;

use App\DTOs\Login\UsuarioAutenticado;

class AutenticacaoRepository {
  public function buscarUsuarioPorEmail(string $email): ?UsuarioAutenticado {
    $sql = "
      SELECT * FROM ViewUsuarioLogin
      WHERE Email = :email
      AND StatusUsuario = 'ATIVO'
    ";

    $stmt = new \PDO('', '', '')->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(\PDO::FETCH_CLASS, UsuarioAutenticado::class);
    return $result ?: null;
  }
}
