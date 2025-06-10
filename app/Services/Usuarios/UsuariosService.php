<?php
namespace App\Services\Usuarios;

use App\Repositories\Usuarios\UsuariosRepository;
use App\DTOs\Usuarios\CadastroUsuario;

class UsuariosService {
    public function __construct(private UsuariosRepository $repository) {}

    public function cadastrarUsuario(CadastroUsuario $dto): bool {
        // Verifica se o email já existe
        if ($this->repository->verificarEmailExistente($dto->email)) {
            throw new \Exception('E-mail já cadastrado!');
        }

        // Hash da senha
        $senhaHash = password_hash($dto->senha, PASSWORD_BCRYPT);

        // Cadastra endereço
        $idEndereco = $this->repository->cadastrarEndereco(
            $dto->cep,
            $dto->estado,
            $dto->cidade,
            $dto->bairro,
            $dto->rua
        );

        // Cadastra credencial
        $idCredencial = $this->repository->cadastrarCredencial(
            $dto->email,
            $senhaHash
        );

        // Cadastra usuário
        return $this->repository->cadastrarUsuario(
            $dto->nome,
            $dto->cpf,
            $dto->telefone,
            $dto->dataNascimento,
            $idCredencial,
            $idEndereco
        );
    }

    /**
     * Verifica o tipo do usuário (CLIENTE ou PRESTADOR) baseado em suas publicações
     * @param int $idUsuario ID do usuário a ser verificado
     * @return string "CLIENTE" ou "PRESTADOR"
     */
    public function verificarTipoUsuario(int $idUsuario): string {
        return $this->repository->verificarTipoUsuario($idUsuario);
    }
} 