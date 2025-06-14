<?php
namespace App\Entities\Views;

use KissPhp\Abstractions\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'ViewUsuarioLogin')]
class ViewUsuarioLogin extends Entity {
  #[ORM\Id]
  #[ORM\Column(type: "integer")]
  public int $id;

  #[ORM\Column(length: 50)]
  public string $nome;

  #[ORM\Column(length: 255, nullable: true)]
  public ?string $foto = null;

  #[ORM\Column(length: 50)]
  public string $statusUsuario;

  #[ORM\Column(length: 255)]
  public string $email;

  #[ORM\Column(length: 255)]
  public string $senha;

  #[ORM\Column(length: 50)]
  public string $grupo;
} 