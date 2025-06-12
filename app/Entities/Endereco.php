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
class Endereco extends KissEntity {
  #[Id]
  #[GeneratedValue]
  #[Column(type: "integer", unsigned: true)]
  public ?int $id = null;

  #[Column(length: 8)]
  public string $cep;

  #[Column(length: 2)]
  public string $estado;

  #[Column(length: 255)]
  public string $cidade;

  #[Column(length: 255)]
  public string $bairro;

  #[Column(length: 255)]
  public string $rua;

  #[OneToMany(targetEntity: Usuario::class, mappedBy: "endereco")]
  public $usuarios;
} 