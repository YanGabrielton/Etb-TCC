<?php
namespace App\Entities\Usuarios;

use KissPhp\Abstractions\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Endereco extends Entity {
  #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: "integer")]
  public ?int $id = null;

  #[ORM\Column(length: 8)]
  public string $cep;

  #[ORM\Column(length: 2)]
  public string $estado;

  #[ORM\Column(length: 255)]
  public string $cidade;

  #[ORM\Column(length: 255)]
  public string $bairro;

  #[ORM\Column(length: 255)]
  public string $rua;

  #[ORM\OneToMany(targetEntity: Usuario::class, mappedBy: "endereco")]
  public $usuarios;
} 