<?php
namespace App\DTOs\Usuarios;

use KissPhp\Attributes\Data\DTO;

#[DTO]
class CadastroUsuario {
    public function __construct(
        public string $nome,
        public string $cpf,
        public string $email,
        public string $senha,
        public string $telefone,
        public string $cep,
        public string $estado,
        public string $cidade,
        public string $bairro,
        public string $rua,
        public string $dataNascimento
    ) {}
} 