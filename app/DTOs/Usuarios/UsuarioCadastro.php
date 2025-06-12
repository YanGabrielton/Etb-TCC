<?php
namespace App\DTOs\Usuarios;

use App\DTOs\EnderecoCadastroUsuario;

class UsuarioCadastro {
  public readonly string $nome;
  
  public readonly EnderecoCadastroUsuario $endereco;
}