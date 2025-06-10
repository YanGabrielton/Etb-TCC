<?php
namespace App\DTOs\Servicos;

use KissPhp\Attributes\Data\DTO;

#[DTO]
class CadastroServico {
    public function __construct(
        public string $titulo,
        public string $descricao,
        public float $preco,
        public int $categoriaServico,
        public int $idUsuario,
        public ?string $fotoNome = null
    ) {}
} 