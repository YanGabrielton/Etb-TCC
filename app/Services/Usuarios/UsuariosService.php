<?php
namespace App\Services\Usuarios;

use App\DTOs\Usuario\UsuarioCadastroDTO;

use App\Repositories\Usuarios\UsuariosRepository;
use App\Repositories\Credenciais\CredencialRepository;

class UsuariosService {
  public function __construct(
    private UsuariosRepository $usuarioRepository,
    private CredencialRepository $credencialRepository
  ) { }

  public function cadastrarUsuario(UsuarioCadastroDTO $usuarioDTO): bool {
    if ($this->credencialRepository->verificarEmailExistente($usuarioDTO->email)) {
      return false;
    }
    $senhaHash = password_hash($usuarioDTO->senha, PASSWORD_BCRYPT);
    return $this->usuarioRepository->cadastrar($usuarioDTO, $senhaHash);
  }
}
