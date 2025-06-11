<?php
namespace App\Controllers;

use KissPhp\Abstractions\WebController;
use KissPhp\Attributes\Http\Controller;

use KissPhp\Enums\FlashMessageType;
use KissPhp\Protocols\Http\Request;

use KissPhp\Attributes\Http\Request\Body;
use KissPhp\Attributes\Http\Methods\{ Get, Post };

use App\DTOs\Login\UsuarioLogin;
use App\Services\Autenticacao\AutenticacaoService;

#[Controller('/autenticacao')]
class AutenticacaoController extends WebController {
  public function __construct(private AutenticacaoService $service) { }

  #[Get()]
  public function exibirPaginaDeLogin(Request $request) {
    $this->render('Pages/login.twig', [
      // 'flashMessage' => $request->session->getFlashMessage()
    ]);
  }

  #[Post()]
  public function autenticar(#[Body] UsuarioLogin $user, Request $request) {
    $session = $request->session;
    $usuarioAutenticado = $this->service->obterUsuarioAutenticado($user);

    if ($usuarioAutenticado) {
      $session->setFlashMessage(FlashMessageType::Success, 'Usuário autenticado com sucesso!');
      return $this->redirect('/servicos');
    }
    $session->setFlashMessage(FlashMessageType::Error, 'Usuário inválido!');
    return $this->redirect('/autenticacao');
  }

  #[Get('/sair')]
  public function finalizarSessao(Request $request) {
    $request->session->clearAll();
    return $this->redirect('/autenticacao');
  }
}