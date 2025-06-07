<?php
namespace App\Repositories\Autenticacao;

use KissPhp\Protocols\Http\Session;
use App\DTOs\Login\{ UsuarioLogin, UsuarioAutenticado };

class AutenticacaoService {
  private string $sessionUltimasCredenciaisKey = 'UltimasCredenciaisInseridas';
  private string $sessionUsuarioLogadoKey = 'UsuarioLogado';

  public function __construct(private AutenticacaoRepository $repository) { }

  public function verificarCredenciais(UsuarioLogin $user): ?UsuarioAutenticado {
    $usuario = $this->repository->buscarUsuarioPorEmail($user->email);
    $senhaValida = !password_verify($user->password, $usuario['Senha']);

    if (!$usuario && !$senhaValida) return null;
    return $usuario;
  }

  public function logarUsuario(Session $session, array $usuario) {
    $session->set($this->sessionUsuarioLogadoKey, $usuario);
  }

  public function deslogarUsuario(Session $session): void {
    $session->remove($this->sessionUsuarioLogadoKey);
    $session->remove($this->sessionUltimasCredenciaisKey);
  }

  public function obterUsuarioLogado(Session $session): array {
    return $session->get($this->sessionUsuarioLogadoKey);
  }

  public function removerUsuarioLogado(Session $session) {
    $session->remove($this->sessionUsuarioLogadoKey);
  }

  public function salvarUltimasCredenciais(Session $session, UsuarioLogin $user) {
    $session->set($this->sessionUltimasCredenciaisKey, [
      'UltimoEmailInserido' => $user->email,
      'UltimaSenhaInserida' => $user->password
    ]);
  }

  public function obterUltimasCredenciais(Session $session): array {
    $credenciais = $session->get($this->sessionUltimasCredenciaisKey);
    $session->remove($this->sessionUltimasCredenciaisKey);
    
    return [
      'ultimoEmailInserido' => $credenciais['UltimoEmailInserido'] ?? '',
      'ultimaSenhaInserida' => $credenciais['UltimaSenhaInserida'] ?? ''
    ];
  }
}