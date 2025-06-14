<?php
namespace App\Entities\Usuarios;

use KissPhp\Abstractions\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


#[ORM\Entity, ORM\Table(name:"NivelAcesso")]
class NivelAcesso extends Entity {
  #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: "integer", name: "ID")]
  public ?int $id = null;

  #[ORM\Column(length: 255, name: "Grupo")]
  public string $grupo;

  #[ORM\OneToMany(targetEntity: Credencial::class, mappedBy: "nivelAcesso")]
  public ArrayCollection $credenciais;

  public function __construct() {
    $this->credenciais = new ArrayCollection();
  }
}