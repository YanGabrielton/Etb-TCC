<?php
namespace App\Entities;

use KissPhp\Abstractions\Entity as KissEntity;

use Doctrine\ORM\Mapping\{
  Id,
  Column,
  Entity,
  ManyToOne,
  OneToMany,
  ManyToMany,
  JoinColumn,
  GeneratedValue,
  JoinTable
};


#[Entity]
class PublicacaoServico extends KissEntity {
  #[Id]
  #[GeneratedValue]
  #[Column(type: "integer")]
  public ?int $id = null;

  #[Column(length: 50)]
  public string $titulo;

  #[Column(length: 255, nullable: true)]
  public ?string $sobre = null;

  #[Column(type: "decimal", precision: 7, scale: 2)]
  public float $valor;

  #[Column(type: "integer")]
  public int $quantidadeFavorito = 0;

  #[ManyToOne(targetEntity: CategoriaServico::class)]
  #[JoinColumn(name: "FKCategoria", referencedColumnName: "id", nullable: false)]
  public CategoriaServico $categoria;

  #[ManyToOne(targetEntity: Usuario::class)]
  #[JoinColumn(name: "FKUsuario", referencedColumnName: "id", nullable: false)]
  public Usuario $usuario;

  #[Column(type: "datetime")]
  public \DateTime $dataCriacao;

  #[Column(type: "datetime", nullable: true)]
  public ?\DateTime $ultimaAtualizacao = null;

  #[Column(type: "string", enumType: StatusPublicacao::class)]
  public string $statusPublicacao = 'EM_ANALISE';

  #[ManyToMany(targetEntity: Usuario::class, inversedBy: "servicosFavoritos")]
  #[JoinTable(name: "ServicoFavorito",
    joinColumns: [new JoinColumn(name: "IDServico", referencedColumnName: "id")],
    inverseJoinColumns: [new JoinColumn(name: "IDUsuario", referencedColumnName: "id")]
  )]
  public $usuariosFavoritos;

  #[OneToMany(targetEntity: AvaliacaoServico::class, mappedBy: "publicacao")]
  public $avaliacoes;

  public function __construct() {
    $this->dataCriacao = new \DateTime();
    $this->usuariosFavoritos = new \Doctrine\Common\Collections\ArrayCollection();
    $this->avaliacoes = new \Doctrine\Common\Collections\ArrayCollection();
  }
} 