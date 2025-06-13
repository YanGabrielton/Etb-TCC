<?php
namespace App\Services\Autenticacao;

use App\Repositories\Autenticacao\AutenticacaoRepository;
use App\DTOs\Login\{ Credenciais, UsuarioAutenticado };

class AutenticacaoService {
  public function __construct(private AutenticacaoRepository $repository) { }

  public function obterUsuarioAutenticado(Credenciais $credenciais): ?UsuarioAutenticado {
    $usuario = $this->repository->buscarUsuarioPorEmail($credenciais->email);
    if (!$usuario) return null;

    $senhaValida = password_verify(
      $credenciais->senha,
      $usuario->credencial->senha
    );
    return $senhaValida ? $usuario : null;
  }
}