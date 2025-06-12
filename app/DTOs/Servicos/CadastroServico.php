<?php
namespace App\DTOs\Servicos;

class CadastroServico {
  public readonly string $titulo;
  public readonly string $descricao;
  public readonly float $preco;
  public readonly int $categoria;
  public readonly int $usuario;
  public readonly ?string $foto;
}