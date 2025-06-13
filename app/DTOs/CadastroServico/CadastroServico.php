<?php
namespace App\DTOs\CadastroServico;

class CadastroServico {
  public readonly string $titulo;
  public readonly string $descricao;
  public readonly float $preco;
  public readonly int $categoria;
  public readonly int $usuario;
  public readonly ?string $foto;
}