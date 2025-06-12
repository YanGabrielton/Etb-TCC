<?php
namespace App\Services\Autenticacao;

use App\DTOs\CredenciaisLogin;
use App\DTOs\Usuarios\UsuarioAutenticado;
use App\Repositories\Autenticacao\AutenticacaoRepository;

class AutenticacaoService {
  public function __construct(private AutenticacaoRepository $repository) { }

  public function obterUsuarioAutenticado(
    CredenciaisLogin $credenciais
  ): ?UsuarioAutenticado {
    $usuario = $this->repository->buscarUsuarioPorEmail($credenciais->email);
    if (!$usuario) return null;

    $senhaValida = password_verify(
      $credenciais->senha,
      $usuario->credencial->senha
    );
    return $senhaValida ? $usuario : null;
  }
}