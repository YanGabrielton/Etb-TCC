<?php
namespace App\Services\Usuarios;

use App\DTOs\Usuario\UsuarioCadastroDTO;

use App\DTOs\Usuario\UsuarioMeuPerfilDTO;
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

  public function obterUsuarioPeloId(int $id): ?UsuarioMeuPerfilDTO {
    try {
      if (!$id) {
        error_log("[Error] UsuariosService::buscarDadosCompletosUsuario: ID do usuário inválido");
        return null;
      }
      $usuario = $this->usuarioRepository->buscarPorId($id);
      
      if (!$usuario) {
        error_log("[Error] UsuariosService::buscarDadosCompletosUsuario: Usuário não encontrado");
        return null;
      }
      return $usuario->toObject(UsuarioMeuPerfilDTO::class);
    } catch (\Throwable $th) {
      error_log("[Error] UsuariosService::buscarDadosCompletosUsuario: {$th->getMessage()}");
      return null;
    }
  }
}
