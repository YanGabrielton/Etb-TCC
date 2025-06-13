<?php
namespace App\Services\Servicos;

use App\Entities\CategoriaServico;
use App\DTOs\Servicos\CadastroServico;
use App\DTOs\Servicos\ServicoDTO;
use App\Repositories\Servicos\ServicosRepository;

class ServicosService {
  public function __construct(private ServicosRepository $repository) { }

  /** @return CategoriaServico[] */
  public function buscarCategorias(): array {
    return $this->repository->buscarCategorias();
  }

  /** @return ServicoDTO[] */
  public function buscarServicos(?int $categoriaId = null): array {
    return $this->repository->buscarServicos($categoriaId);
  }

  public function cadastrarServico(CadastroServico $dto, ?array $foto): bool {
    try {
      if ($foto && $foto['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);
        $fotoFile = "img/servicos/" . uniqid() . "." . $ext;
        $caminhoAbsoluto = $_SERVER["DOCUMENT_ROOT"] . "/src/" . $fotoFile;
        
        if (!move_uploaded_file($foto['tmp_name'], $caminhoAbsoluto)) {
          throw new \Exception('Erro ao enviar imagem!');
        }
        
        $dto->fotoNome = $fotoFile;
      }

      return $this->repository->cadastrarServico($dto);
    } catch (\Exception $e) {
      // Se houver erro no upload da foto, tenta cadastrar sem a foto
      if ($dto->fotoNome) {
        $dto->fotoNome = null;
        return $this->repository->cadastrarServico($dto);
      }
      throw $e;
    }
  }

  /**
   * Desativa um serviço e atualiza o nível de acesso do usuário se necessário
   * @param int $idServico ID do serviço a ser desativado
   * @param int $idUsuario ID do usuário que está desativando o serviço
   * @return bool true se o serviço foi desativado com sucesso
   * @throws \Exception se houver erro ao desativar o serviço
   */
  public function desativarServico(int $idServico, int $idUsuario): bool {
    return $this->repository->desativarServico($idServico, $idUsuario);
  }
}