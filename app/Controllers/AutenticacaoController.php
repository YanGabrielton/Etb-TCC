<?php
namespace App\Controllers;

use KissPhp\Attributes\Data\DTO;
use KissPhp\Protocols\Http\Request;
use KissPhp\Abstractions\WebController;
use KissPhp\Attributes\Http\{ Controller, Get, Post };

use App\DTOs\Login\UsuarioLogin;
use App\Services\Autenticacao\AutenticacaoService;

use function App\Utils\bp;

#[Controller('/autenticacao')]
class AutenticacaoController extends WebController {
  public function __construct(private AutenticacaoService $service) { }

  #[Get()]
  public function exibirPaginaDeLogin(Request $request) {
    $session = $request->session;
    $ultimasCredenciaisInseridas = $session->get('UltimasCredenciaisInseridas');

    $this->render('Pages/login/page', [
      'UltimasCredenciaisInseridas' => $ultimasCredenciaisInseridas ?? [],
    ]);
  }

  #[Post()]
  public function autenticar(#[DTO] UsuarioLogin $user, Request $request) {
    $session = $request->session;
    $usuarioAutenticado = $this->service->obterUsuarioAutenticado($user);

    if ($usuarioAutenticado) {
      $session->set('UsuarioAutenticado', $usuarioAutenticado);
      return $this->redirect('/servicos');
    }
    $session->set('UltimasCredenciaisInseridas', $user);
    return $this->redirect('/autenticacao');
  }

  #[Get('/sair')]
  public function finalizarSessao(Request $request) {
    $request->session->clear();
    return $this->redirect('/autenticacao');
  }
}