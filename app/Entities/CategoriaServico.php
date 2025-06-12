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
class CategoriaServico extends KissEntity {
  #[Id]
  #[GeneratedValue]
  #[Column(type: "integer", unsigned: true)]
  public ?int $id = null;

  #[Column(length: 25)]
  public string $nome;

  #[OneToMany(targetEntity: PublicacaoServico::class, mappedBy: "categoria")]
  public $publicacoesServico;

  public function __construct() {
    $this->publicacoesServico = new \Doctrine\Common\Collections\ArrayCollection();
  }
} 