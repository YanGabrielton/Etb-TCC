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

  public function buscarDadosCompletosUsuario(int $idUsuario): ?array {
    try {
      $usuario = $this->usuarioRepository->buscarPorId($idUsuario);
      if (!$usuario) return null;

      return [
        'id' => $usuario->id,
        'nome' => $usuario->nome,
        'cpf' => $usuario->cpf,
        'foto' => $usuario->foto,
        'celular' => $usuario->celular,
        'dataNascimento' => $usuario->dataNascimento->format('Y-m-d'),
        'email' => $usuario->credencial->email,
        'statusUsuario' => $usuario->statusUsuario->value,
        'endereco' => $usuario->endereco ? [
          'cep' => $usuario->endereco->cep,
          'estado' => $usuario->endereco->estado,
          'cidade' => $usuario->endereco->cidade,
          'bairro' => $usuario->endereco->bairro,
          'rua' => $usuario->endereco->rua
        ] : null
      ];
    } catch (\Throwable $th) {
      error_log("[Error] UsuariosService::buscarDadosCompletosUsuario: {$th->getMessage()}");
      return null;
    }
  }
}
