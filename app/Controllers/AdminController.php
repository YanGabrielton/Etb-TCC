<?php
namespace App\Controllers;

use KissPhp\Abstractions\WebController;
use KissPhp\Attributes\Http\Controller;
use KissPhp\Attributes\Http\Methods\Get;

#[Controller('/admin')]
class AdminController extends WebController {
  #[Get('/painel')]
  public function exbibirPaginaPainel() {
    $this->render('Pages/admin/painel.twig');
  }
}