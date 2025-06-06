<?php
namespace App\Controllers;

use KissPhp\Attributes\Data\DTO;
use KissPhp\Protocols\Http\Request;
use KissPhp\Attributes\Http\{ Controller, Get, Post };

use App\DTOs\Login\UserLogin;
use KissPhp\Abstractions\WebController;

#[Controller('/autenticacao')]
class AutenticacaoController extends WebController {
  private string $sessionKey = 'UltimasCredenciaisInseridas';

  #[Get('')]
  public function exibirPaginaDeLogin(Request $request) {
    $user = $request->session->get($this->sessionKey);
    $request->session->remove($this->sessionKey);

    $this->render('Pages/autenticacao/page', [
      'user' => $user['UltimoEmailInserido'] ?? '',
      'password' => $user['UltimaSenhaInserida'] ?? '',
    ]);
  }

  #[Post('')]
  public function autenticar(#[DTO] UserLogin $user) {
    
  }

  #[Get('/sair')]
  public function finalizarSessao(Request $request) {
    
  }
}