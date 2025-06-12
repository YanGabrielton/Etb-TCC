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
class AvaliacaoServico extends KissEntity {
  #[Id]
  #[GeneratedValue]
  #[Column(type: "integer", unsigned: true)]
  public ?int $id = null;

  #[Column(type: "integer", unsigned: true)]
  public int $nota = 0;

  #[Column(length: 255, nullable: true)]
  public ?string $comentario = null;

  #[ManyToOne(targetEntity: PublicacaoServico::class)]
  #[JoinColumn(name: "FkPublicacao", referencedColumnName: "id", nullable: false)]
  public PublicacaoServico $publicacao;

  #[ManyToOne(targetEntity: Usuario::class)]
  #[JoinColumn(name: "FKUsuario", referencedColumnName: "id", nullable: false)]
  public Usuario $usuario;

  #[Column(type: "datetime")]
  public \DateTime $dataCriacao;

  #[Column(type: "datetime", nullable: true)]
  public ?\DateTime $ultimaAtualizacao = null;

  public function __construct() {
    $this->dataCriacao = new \DateTime();
  }
} 