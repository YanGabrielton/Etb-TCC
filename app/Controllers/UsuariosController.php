<?php

namespace App\Controllers;

use KissPhp\Abstractions\WebController;
use KissPhp\Attributes\Http\Controller;

use KissPhp\Attributes\Http\Methods\{ Get, Post };
use KissPhp\Attributes\Http\Request\{ Body, RouteParam };

use KissPhp\Enums\FlashMessageType;
use KissPhp\Protocols\Http\Request;

use App\DTOs\Usuario\UsuarioCadastroDTO;
use App\Services\Usuarios\UsuariosService;

#[Controller('/usuarios')]
class UsuariosController extends WebController {
  public function __construct(private UsuariosService $service) {}

  #[Get('/cadastro')]
  public function exibirPaginaDeCadastro() {
    $this->render('Pages/usuarios/cadastro.twig', []);
  }

  #[Get('/meu-perfil')]
  public function exibirPaginaDeMeuPerfil() {
    $this->render('Pages/usuarios/meu-perfil.twig', []);
  }

  #[Post('/cadastro')]
  public function cadastrarUsuario(#[Body] UsuarioCadastroDTO $usuario, Request $request) {
    $foiCadastrado = $this->service->cadastrarUsuario($usuario);

    if (!$foiCadastrado) {
      $request->session->setFlashMessage(FlashMessageType::Error, 'Não foi possível terminar o cadastro :/');
      return $this->redirectTo('/usuarios/cadastro');
    }

    $request->session->setFlashMessage(FlashMessageType::Success, 'Cadastro realizado com sucesso!');
    return $this->redirectTo('/autenticacao');
  }
}
