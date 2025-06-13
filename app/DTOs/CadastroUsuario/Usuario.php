<?php
namespace App\DTOs\CadastroUsuario;

class Usuario {
  public readonly string $nome;
  public readonly string $email;
  public readonly string $senha;
  public readonly string $cpf;
  public readonly string $telefone;
  public readonly string $dataNascimento;
  public readonly Endereco $endereco;
}