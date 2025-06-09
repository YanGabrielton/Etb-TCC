<?php
namespace App\Services\Servicos;

use App\Repositories\Servicos\ServicosRepository;
use App\DTOs\Servicos\{ CadastroServico, Categoria };

class ServicosService {
  public function __construct(private ServicosRepository $repository) { }

  /** @return Categoria[] */
  public function buscarCategorias(): array {
    return $this->repository->buscarCategorias();
  }

  public function buscarServicos(): array {
    return $this->repository->buscarServicos();
  }

  public function cadastrarServico(CadastroServico $dto, ?array $foto): bool {
    if ($foto && $foto['error'] === UPLOAD_ERR_OK) {
      $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);
      $fotoFile = "img/servicos/" . uniqid() . "." . $ext;
      $caminhoAbsoluto = $_SERVER["DOCUMENT_ROOT"] . "/src/" . $fotoFile;
      
      if (!move_uploaded_file($foto['tmp_name'], $caminhoAbsoluto)) {
        throw new \Exception('Erro ao enviar imagem!');
      }
    }
    return $this->repository->cadastrarServico($dto);
  }
}