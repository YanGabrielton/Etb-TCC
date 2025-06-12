<?php
namespace App\Repositories\Autenticacao;

use KissPhp\Abstractions\Repository;

use App\Models\Usuario;

class AutenticacaoRepository extends Repository {
  public function buscarUsuarioPorEmail(string $email): ?Usuario {
    $sql = "
      SELECT * FROM ViewUsuarioLogin
      WHERE Email = ?
      AND StatusUsuario = 'ATIVO'
    ";

    // try {
    //   $stmt = $this->database()->prepare($sql);
    //   $stmt->bind_param('s', $email);
    //   $stmt->execute();
      
    //   $result = $stmt->get_result();
    //   $row = $result->fetch_object(Usuario::class);

    //   return $row;
    // } catch (\Throwable $th) {
    //   error_log("[Error] AutenticacaoRepository: {$th->getMessage()}");
    //   return null;
    // }
  }
}
