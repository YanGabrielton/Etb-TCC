<?php
namespace App\DTOs\Servicos;

class CadastroServico {
  public readonly string $descricao;

  public readonly float $preco;
  public readonly int $categoriaServico;
  public readonly ?string $horario;
  public readonly ?string $fotoNome;
  public readonly int $idUsuario;
} 