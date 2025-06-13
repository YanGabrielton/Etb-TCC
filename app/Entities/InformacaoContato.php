<?php
namespace App\Entities;

use KissPhp\Abstractions\Entity as KissEntity;

use Doctrine\ORM\Mapping\{
  Id,
  Column,
  Entity,
  ManyToOne,
  JoinColumn,
  GeneratedValue
};


#[Entity]
class InformacaoContato extends KissEntity {
  #[Id]
  #[GeneratedValue]
  #[Column(type: "integer")]
  public ?int $id = null;

  #[Column(length: 255, nullable: true)]
  public ?string $contato = null;

  #[ManyToOne(targetEntity: Usuario::class)]
  #[JoinColumn(name: "FKUsuario", referencedColumnName: "id", nullable: false)]
  public Usuario $usuario;

  #[ManyToOne(targetEntity: CategoriaContato::class)]
  #[JoinColumn(name: "FKCategoriaContato", referencedColumnName: "id", nullable: false)]
  public CategoriaContato $categoriaContato;
} 