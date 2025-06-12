<?php
namespace App\Controllers;

use KissPhp\Abstractions\WebController;
use KissPhp\Attributes\Http\Controller;

use KissPhp\Enums\FlashMessageType;
use KissPhp\Protocols\Http\Request;

use KissPhp\Attributes\Http\Request\Body;
use KissPhp\Attributes\Http\Methods\{ Get, Post };

use App\DTOs\CredenciaisLogin;
use App\Services\Autenticacao\AutenticacaoService;

#[Controller('/autenticacao')]
class AutenticacaoController extends WebController {
  public function __construct(private AutenticacaoService $service) { }

  #[Get]
  public function exibirPaginaDeLogin(Request $request) {
    $this->render('Pages/login.twig', [
      'flash_message' => $request->session->getFlashMessage()
    ]);
  }

  #[Post]
  public function autenticar(#[Body] CredenciaisLogin $usuario, Request $request) {
    $usuarioAutenticado = $this->service->obterUsuarioAutenticado($usuario);

    if ($usuarioAutenticado) {
      $request->session->setFlashMessage(FlashMessageType::Success, 'Usuário autenticado com sucesso!');
      return $this->redirect('/servicos');
    }
    $request->session->setFlashMessage(FlashMessageType::Error, 'Usuário inválido!');
    return $this->redirect('/autenticacao');
  }

  #[Get('/sair')]
  public function finalizarSessao(Request $request) {
    $request->session->clearAll();
    return $this->redirect('/autenticacao');
  }
}