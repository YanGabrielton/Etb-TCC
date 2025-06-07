<?php
namespace App\Controllers;

use KissPhp\Attributes\Data\DTO;
use KissPhp\Protocols\Http\Request;
use KissPhp\Abstractions\WebController;
use KissPhp\Attributes\Http\{ Controller, Get, Post };

use App\DTOs\Login\UsuarioLogin;
use App\Repositories\Autenticacao\AutenticacaoService;

#[Controller('/autenticacao')]
class AutenticacaoController extends WebController {
  public function __construct(private AutenticacaoService $service) { }

  #[Get()]
  public function exibirPaginaDeLogin(Request $request) {
    $session = $request->session;
    $ultimasCredenciaisInseridas = $this->service->obterUltimasCredenciais($session);
    $this->render('Pages/login/page', $ultimasCredenciaisInseridas);
  }

  #[Post()]
  public function autenticar(#[DTO] UsuarioLogin $user, Request $request) {
    $session = $request->session;
    $userVerificado = $this->service->verificarCredenciais($user);

    if ($userVerificado !== null) {
      $this->service->salvarUltimasCredenciais($session, $user);
      return $this->redirect('/servicos');
    }
    $this->service->salvarUltimasCredenciais($session, $user);
    return $this->redirect('/autenticacao');
  }

  #[Get('/sair')]
  public function finalizarSessao(Request $request) {
    $this->service->deslogarUsuario($request->session);
    return $this->redirect('/autenticacao');
  }
}