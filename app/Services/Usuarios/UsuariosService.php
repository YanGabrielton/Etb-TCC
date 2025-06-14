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
      if (!$idUsuario) {
        error_log("[Error] UsuariosService::buscarDadosCompletosUsuario: ID do usuário inválido");
        return null;
      }

      $usuario = $this->usuarioRepository->buscarPorId($idUsuario);
      
      if (!$usuario) {
        error_log("[Error] UsuariosService::buscarDadosCompletosUsuario: Usuário não encontrado");
        return null;
      }

      if (!$usuario->credencial) {
        error_log("[Error] UsuariosService::buscarDadosCompletosUsuario: Credenciais do usuário não encontradas");
        return null;
      }

      $dataNascimento = $usuario->dataNascimento instanceof \DateTime 
        ? $usuario->dataNascimento->format('Y-m-d')
        : null;

      if (!$dataNascimento) {
        error_log("[Error] UsuariosService::buscarDadosCompletosUsuario: Data de nascimento inválida");
        return null;
      }

      return [
        'id' => $usuario->id,
        'nome' => $usuario->nome ?? '',
        'cpf' => $usuario->cpf ?? '',
        'foto' => $usuario->foto,
        'celular' => $usuario->celular,
        'dataNascimento' => $dataNascimento,
        'email' => $usuario->credencial->email ?? '',
        'statusUsuario' => $usuario->statusUsuario?->value ?? 'ATIVO',
        'endereco' => $usuario->endereco ? [
          'cep' => $usuario->endereco->cep ?? '',
          'estado' => $usuario->endereco->estado ?? '',
          'cidade' => $usuario->endereco->cidade ?? '',
          'bairro' => $usuario->endereco->bairro ?? '',
          'rua' => $usuario->endereco->rua ?? ''
        ] : null
      ];
    } catch (\Throwable $th) {
      error_log("[Error] UsuariosService::buscarDadosCompletosUsuario: {$th->getMessage()}");
      return null;
    }
  }
}
