<?php
namespace App\Services\Usuarios;

use App\DTOs\CadastroUsuario\Usuario;
use App\Repositories\Usuarios\UsuariosRepository;

class UsuariosService {
  public function __construct(private UsuariosRepository $repository) {}

  public function cadastrarUsuario(Usuario $usuario): bool {
    if ($this->repository->verificarEmailExistente($usuario->email)) {
      return false;
    }
    
    $senhaHash = password_hash($usuario->senha, PASSWORD_BCRYPT);
    $idEndereco = $this->repository->cadastrarEndereco($usuario->endereco);

    $idCredencial = $this->repository->cadastrarCredencial(
      $usuario->email, $senhaHash
    );

    return $this->repository->cadastrarUsuario(
      $usuario, $idCredencial, $idEndereco
    );
  }
}
