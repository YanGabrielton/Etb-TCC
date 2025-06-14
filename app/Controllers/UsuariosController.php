<?php
namespace App\Controllers;

use App\Utils\SessionKeys;
use KissPhp\Abstractions\WebController;
use KissPhp\Attributes\Http\Controller;

use KissPhp\Attributes\Http\Request\{ Body };
use KissPhp\Attributes\Http\Methods\{ Get, Post };

use KissPhp\Enums\FlashMessageType;
use KissPhp\Protocols\Http\Request;

use App\DTOs\Usuario\UsuarioCadastroDTO;
use App\Services\Usuarios\UsuariosService;

use App\Middlewares\VerificaSeUsuarioLogado;
use App\Middlewares\VerificaSeUsuarioNaoLogado;


#[Controller('/usuarios')]
class UsuariosController extends WebController {
  public function __construct(private UsuariosService $service) { }

  #[Get('/cadastro', [VerificaSeUsuarioNaoLogado::class])]
  public function exibirPaginaDeCadastro() {
    $this->render('Pages/usuarios/cadastro.twig', []);
  }

  #[Get('/meu-perfil', [VerificaSeUsuarioLogado::class])]
  public function exibirPaginaDeMeuPerfil(Request $request) {
    $usuarioLogado = $request->session->get(SessionKeys::USUARIO_AUTENTICADO);
    $dadosCompletos = $this->service->buscarDadosCompletosUsuario($usuarioLogado->id);

    if (!$dadosCompletos) {
      $request->session->setFlashMessage(FlashMessageType::Error, 'Não foi possível carregar os dados do perfil :/');
    }

    $this->render('Pages/usuarios/meu-perfil.twig', [
      'usuario' => $dadosCompletos
    ]);
  }

  #[Post('/cadastro', [VerificaSeUsuarioNaoLogado::class])]
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
