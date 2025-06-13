<?php
namespace App\Services\Autenticacao;

use App\DTOs\Login\{ Credenciais, UsuarioAutenticado };
use App\Repositories\Credenciais\CredencialRepository;

class AutenticacaoService {
  public function __construct(private CredencialRepository $repository) { }

  public function obterUsuarioAutenticado(Credenciais $credenciais): ?UsuarioAutenticado {
    $credenciaisDoBanco = $this->repository->buscarPorEmail($credenciais->email);
    if (!$credenciaisDoBanco) return null;

    $senhaValida = password_verify($credenciais->senha, $credenciaisDoBanco->senha);
    if (!$senhaValida) return null;
    
    return $credenciaisDoBanco->toObject(UsuarioAutenticado::class);
  }
}