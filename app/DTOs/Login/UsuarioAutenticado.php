<?php
namespace App\DTOs\Login;

class UsuarioAutenticado {
  public readonly string $id;
  public readonly string $nome;
  public readonly string $email;
  public readonly string $senha;
}