<?php
namespace App\DTOs;

class EnderecoCadastroUsuario {
  public readonly string $cep;
  public readonly string $estado;
  public readonly string $rua;
  public readonly string $cidade;
}