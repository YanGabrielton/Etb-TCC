<?php
namespace App\Entities\Usuarios;

use KissPhp\Abstractions\Entity as KissEntity;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class Credencial extends KissEntity {
  #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: "integer")]
  public ?int $id = null;

  #[ORM\Column(length: 100, unique: true)]
  public string $email;

  #[ORM\Column(length: 60)]
  public string $senha;

  #[ORM\ManyToOne(targetEntity: NivelAcesso::class)]
  #[ORM\JoinColumn(name: "FKNivelAcesso", referencedColumnName: "id", nullable: false)]
  public NivelAcesso $nivelAcesso;

  #[ORM\OneToOne(targetEntity: Usuario::class, mappedBy: "credencial")]
  public ?Usuario $usuario = null;
} 