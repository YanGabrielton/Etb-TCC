<?php

namespace App\Controllers;

use KissPhp\Abstractions\WebController;
use KissPhp\Attributes\Http\Controller;

use KissPhp\Attributes\Http\Methods\{ Get, Post };
use KissPhp\Attributes\Http\Request\{ Body, RouteParam };

use App\DTOs\Usuarios\UsuarioCadastro;
use App\Services\Usuarios\UsuariosService;

#[Controller('/usuarios')]
class UsuariosController extends WebController {
  // public function __construct(private UsuariosService $service) {}

  #[Get('/cadastro')]
  public function exibirPaginaDeCadastro() {
    $this->render('Pages/usuarios/cadastro.twig', []);
  }

  #[Get('/meu-perfil')]
  public function exibirPaginaDeMeuPerfil() {
    $this->render('Pages/usuarios/meu-perfil.twig', []);
  }

  #[Post('/cadastro')]
  public function cadastrarUsuario(#[Body] UsuarioCadastro $usuario) {
    // try {
    //   $this->service->cadastrarUsuario($usuario);
    //   return $this->redirect('/login');
    // } catch (\Exception $e) {
    //   $this->session->set('ErroCadastro', $e->getMessage());
    //   return $this->redirect('/usuarios/cadastro');
    // }
  }

  #[Get('/tipo/{id}')]
  public function verificarTipoUsuario(#[RouteParam] int $id) {
    // try {
    //   $tipo = $this->service->verificarTipoUsuario($id);
    //   $this->render('Pages/usuarios/tipo', ['tipo' => $tipo]);
    // } catch (\Exception $e) {
    //   $this->render('Pages/usuarios/tipo', ['erro' => $e->getMessage()]);
    // }
  }
}
