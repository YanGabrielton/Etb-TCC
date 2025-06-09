<?php
namespace App\Repositories\Autenticacao;

use App\DTOs\Login\UsuarioAutenticado;
use App\Utils\DatabaseConnection;

class AutenticacaoRepository {
  public function buscarUsuarioPorEmail(string $email): ?UsuarioAutenticado {
    $sql = "
      SELECT * FROM ViewUsuarioLogin
      WHERE Email = ?
      AND StatusUsuario = 'ATIVO'
    ";
    $db = new DatabaseConnection();

    try {
      $conn = $db->getConnection();
      
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('s', $email);
      $stmt->execute();
      
      $result = $stmt->get_result();
      $row = $result->fetch_object(UsuarioAutenticado::class);

      return $row;
    } catch (\Throwable $th) {
      error_log("[Error] AutenticacaoRepository: {$th->getMessage()}");
      return null;
    } finally {
      $stmt->close();
    }
  }
}
