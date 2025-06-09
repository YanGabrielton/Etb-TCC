<?php
namespace App\DTOs\Servicos;

class Categoria {
  public function __construct(
    public readonly int $ID,
    public readonly string $Nome
  ) { }
}