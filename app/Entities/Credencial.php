<?php
namespace App\Entities;

use KissPhp\Abstractions\Entity as KissEntity;

use Doctrine\ORM\Mapping\{
  Id,
  Column,
  Entity,
  OneToOne,
  ManyToOne,
  JoinColumn,
  GeneratedValue,
};


#[Entity]
class Credencial extends KissEntity {
  #[Id]
  #[GeneratedValue]
  #[Column(type: "integer")]
  public ?int $id = null;

  #[Column(length: 100, unique: true)]
  public string $email;

  #[Column(length: 60)]
  public string $senha;

  #[ManyToOne(targetEntity: NivelAcesso::class)]
  #[JoinColumn(name: "FKNivelAcesso", referencedColumnName: "id", nullable: false)]
  public NivelAcesso $nivelAcesso;

  #[OneToOne(targetEntity: Usuario::class, mappedBy: "credencial")]
  public ?Usuario $usuario = null;
} 