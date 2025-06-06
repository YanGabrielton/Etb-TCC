<?php
namespace App\Controllers;

use KissPhp\Abstractions\WebController;
use KissPhp\Attributes\Http\{ Controller, Get, Post };

#[Controller('/usuarios')]
class UsuariosController extends WebController {
  
  #[Get('/meu-perfil')]
  public function exibirPerfilDoUsuario() {
    $this->render('Pages/usuarios/meu-perfil/meu-perfil');
  }

  #[Get()]
  public function exibirCadastroDeUsuario() {
    $this->render('Pages/usuarios/cadastro/page');
  }
}