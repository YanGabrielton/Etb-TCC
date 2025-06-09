<?php
namespace App\Services\Autenticacao;

use App\DTOs\Login\{ UsuarioLogin, UsuarioAutenticado };
use App\Repositories\Autenticacao\AutenticacaoRepository;

class AutenticacaoService {
  public function __construct(private AutenticacaoRepository $repository) { }

  public function obterUsuarioAutenticado(UsuarioLogin $credenciais): ?UsuarioAutenticado {
    $usuario = $this->repository->buscarUsuarioPorEmail($credenciais->email);
    if (!$usuario) return null;

    $senhaValida = password_verify($credenciais->senha, $usuario->senha);
    return $senhaValida ? $usuario : null;
  }
}