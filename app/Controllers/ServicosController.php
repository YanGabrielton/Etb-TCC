<?php
namespace App\Controllers;

use KissPhp\Protocols\Http\Request;
use KissPhp\Abstractions\WebController;
use KissPhp\Attributes\Http\{ Controller, Get, Post };
use KissPhp\Attributes\Data\DTO;

use App\Services\Servicos\ServicosService;
use App\DTOs\Servicos\CadastroServico;

#[Controller('/servicos')]
class ServicosController extends WebController {
  public function __construct(private ServicosService $service) { }
  
  #[Get()]
  public function exibirPaginaDeServicos() {
    $servicos = $this->service->buscarServicos();

    $this->render('Pages/servicos/page', [
      'Servicos' => $servicos
    ]);
  }

  #[Get('/postar-servico')]
  public function exibirPaginaDePostarServico(Request $request) {
    $session = $request->session;
    $ultimoServicoInserido = $session->get('UltimoServicoInserido');
    $session->remove('UltimoServicoInserido');

    $categorias = $this->service->buscarCategorias();

    $this->render('Pages/servicos/postar-servico-form', [
      'Categorias' => $categorias,
      'UltimoServicoInserido' => $ultimoServicoInserido
    ]);
  }

  #[Post('/postar-servico')]
  public function cadastrarServico(
    Request $request,
    #[DTO] CadastroServico $servico
  ) {
    $foto = $request->body->get('foto');
    $foiCadastrado = $this->service->cadastrarServico($servico, $foto);

    if ($foiCadastrado) return $this->redirect('/servicos');

    $request->session->set('UltimoServicoInserido', $servico);
    return $this->redirect('/servicos/postar-servico');
  }
}