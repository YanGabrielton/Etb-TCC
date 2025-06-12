<?php
namespace App\Controllers;

use KissPhp\Abstractions\WebController;
use KissPhp\Attributes\Http\Controller;
use KissPhp\Attributes\Http\Methods\Get;

#[Controller('/recuper-senha')]
class RecuperarSenha extends WebController {
  #[Get]
  public function exibirPaginaRecuperarSenha() {
    $this->render('Pages/recuperar-senha.twig', [
      
    ]);
  }
}