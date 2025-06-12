<?php
namespace App\Entities;

use KissPhp\Abstractions\Entity as KissEntity;

use Doctrine\ORM\Mapping\{
  Id,
  Column,
  Entity,
  OneToMany,
  GeneratedValue
};


#[Entity]
class NivelAcesso extends KissEntity {
  #[Id]
  #[GeneratedValue]
  #[Column(type: "integer", unsigned: true)]
  public ?int $id = null;

  #[Column(length: 255)]
  public string $grupo;

  #[OneToMany(targetEntity: Credencial::class, mappedBy: "nivelAcesso")]
  public $credenciais;
}