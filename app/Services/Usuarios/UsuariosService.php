<?php
namespace App\Services\Usuarios;

use App\DTOs\Usuarios\UsuarioCadastro;
use App\Repositories\Usuarios\UsuariosRepository;

class UsuariosService {
  public function __construct(private UsuariosRepository $repository) {}

  public function cadastrarUsuario(UsuarioCadastro $usuario): bool {
    $senhaHash = password_hash($usuario->senha, PASSWORD_BCRYPT);
    return $this->repository->cadastrarUsuario($usuario, $senhaHash);
  }

  /**
   * Verifica o tipo do usuário (CLIENTE ou PRESTADOR) baseado em suas publicações
   * @param int $idUsuario ID do usuário a ser verificado
   * @return string "CLIENTE" ou "PRESTADOR"
   */
  public function verificarTipoUsuario(int $idUsuario): string {
    return $this->repository->verificarTipoUsuario($idUsuario);
  }
}
