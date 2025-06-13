<?php
namespace App\DTOs\CadastroUsuario;

class Endereco {
  public readonly string $cep;
  public readonly string $estado;
  public readonly string $rua;
  public readonly string $bairro;
  public readonly string $cidade;
}