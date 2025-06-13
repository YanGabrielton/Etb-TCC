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
class CategoriaContato extends KissEntity {
  #[Id]
  #[GeneratedValue]
  #[Column(type: "integer")]
  private ?int $id = null;

  #[Column(length: 255)]
  private string $nome;

  #[OneToMany(targetEntity: InformacaoContato::class, mappedBy: "categoriaContato")]
  private $informacoesContato;

  public function __construct() {
    $this->informacoesContato = new \Doctrine\Common\Collections\ArrayCollection();
  }
} 