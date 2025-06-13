<?php
namespace App\Controllers;

use KissPhp\Protocols\Http\Request;
use KissPhp\Abstractions\WebController;

use KissPhp\Attributes\Http\Controller;

use KissPhp\Attributes\Http\Methods\{ Get, Post };
use KissPhp\Attributes\Http\Request\{ Body, RouteParam };

use App\Services\Servicos\ServicosService;
use App\DTOs\CadastroServico\CadastroServico;

#[Controller('/servicos')]
class ServicosController extends WebController {
  public function __construct(private ServicosService $service) { }
  
  #[Get()]
  public function exibirPaginaDeServicos() {
    $categorias = $this->service->buscarCategorias();

    $this->render('Pages/servicos/listar-servicos.twig', [
      'categorias' => $categorias
    ]);
  }

  #[Get('/cadastro')]
  public function exibirPaginaDePostarServico(Request $request) {
    // $session = $request->session;
    // $ultimoServicoInserido = $session->get('UltimoServicoInserido');
    
    // $categorias = $this->service->buscarCategorias();

    $this->render('Pages/servicos/cadastro.twig', [
      'Categorias' => []
    ]);
  }

  #[Post('/cadastro')]
  public function cadastrarServico(
    Request $request,
    #[Body] CadastroServico $servico
  ) {
    // $foto = $request->getBody('foto');
    // $foiCadastrado = $this->service->cadastrarServico($servico, $foto);

    // if ($foiCadastrado) return $this->redirect('/servicos');

    // $this->session->set('UltimoServicoInserido', $servico);
    // return $this->redirect('/servicos/postar-servico');
  }

  #[Post('/desativar/{id}')]
  public function desativarServico(#[RouteParam] int $id) {
    // try {
    //   $idUsuario = $this->session->get('id_usuario');
      
    //   if (!$idUsuario) {
    //     return $this->redirect('/login');
    //   }

    //   $this->service->desativarServico($id, $idUsuario);
    //   return $this->redirect('/prestadores?sucesso=1');
    // } catch (\Exception $e) {
    //   return $this->redirect('/prestadores?erro=' . urlencode($e->getMessage()));
    // }
  }
}