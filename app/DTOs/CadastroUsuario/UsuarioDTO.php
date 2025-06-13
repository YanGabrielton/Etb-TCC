<?php
namespace App\DTOs\CadastroUsuario;

class UsuarioDTO {
  public readonly string $nome;
  public readonly string $email;
  public readonly string $senha;
  public readonly string $cpf;
  public readonly string $celular;
  public readonly string $dataNascimento;
  public readonly Endereco $endereco;
}