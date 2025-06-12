<?php
namespace App\DTOs\Servicos;

class CadastroServico {
  public readonly string $titulo;
  public readonly string $descricao;
  public readonly float $preco;
  public readonly int $categoriaServico;
  public readonly int $idUsuario;
  public readonly ?string $fotoNome;
}