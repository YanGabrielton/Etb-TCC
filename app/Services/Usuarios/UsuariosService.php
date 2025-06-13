<?php
namespace App\Services\Usuarios;

use App\Entities\Usuarios\{ Usuario, Endereco };
use App\DTOs\Usuario\{ UsuarioCadastroDTO, EnderecoDTO };

use App\Repositories\Usuarios\UsuariosRepository;
use App\Repositories\Enderecos\EnderecoRepository;
use App\Repositories\Credenciais\CredencialRepository;

class UsuariosService {
  public function __construct(
    private UsuariosRepository $usuarioRepository,
    private EnderecoRepository $enderecoRepository,
    private CredencialRepository $credencialRepository
  ) { }

  public function cadastrarUsuario(UsuarioCadastroDTO $usuarioDTO): bool {
    if ($this->credencialRepository->verificarEmailExistente($usuarioDTO->email)) {
      return false;
    }
    $senhaHash = password_hash($usuarioDTO->senha, PASSWORD_BCRYPT);
    
    $endereco = (new Endereco())->fromObject($usuarioDTO->endereco);
    $idEndereco = $this->enderecoRepository->cadastrar($endereco);

    $idCredencial = $this->credencialRepository->cadastrar($usuarioDTO->email, $senhaHash);

    $usuario = new Usuario();
    $usuario->nome = $usuarioDTO->nome;
    $usuario->cpf = $usuarioDTO->cpf;
    $usuario->celular = $usuarioDTO->celular;
    
    $usuario->dataNascimento = new \DateTime($usuarioDTO->dataNascimento);

    $usuario->credencial = $this->credencialRepository->buscarPorId($idCredencial);
    $usuario->endereco = $this->enderecoRepository->buscarPorId($idEndereco);

    return $this->usuarioRepository->cadastrar($usuario);
  }
}
