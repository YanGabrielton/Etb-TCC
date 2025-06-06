<?php
namespace App\Controllers;

use KissPhp\Abstractions\WebController;
use KissPhp\Attributes\Http\Controller;
use KissPhp\Attributes\Http\Get;

#[Controller('/servicos')]
class ServicosController extends WebController {
  
  #[Get()]
  public function exibirPaginaDeServicos() {
    $this->render('Pages/servicos/page');
  }
}