<?php
namespace App\Entities\Usuarios;

use KissPhp\Abstractions\Entity as KissEntity;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class NivelAcesso extends KissEntity {
  #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: "integer")]
  public ?int $id = null;

  #[ORM\Column(length: 255)]
  public string $grupo;

  #[ORM\OneToMany(targetEntity: Credencial::class, mappedBy: "nivelAcesso")]
  public $credenciais;
}