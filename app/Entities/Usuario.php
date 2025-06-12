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
  GeneratedValue
};

#[Entity]
class Usuario extends KissEntity {
  #[Id]
  #[GeneratedValue]
  #[Column(type: "integer", unsigned: true)]
  public ?int $id = null;

  #[Column(length: 50)]
  public string $nome;

  #[Column(length: 11, unique: true)]
  public string $cpf;

  #[Column(length: 255, nullable: true)]
  public ?string $foto = null;

  #[Column(length: 11, nullable: true)]
  public ?string $celular = null;

  #[Column(type: "date")]
  public \DateTime $dataNascimento;

  #[ManyToOne(targetEntity: Credencial::class)]
  #[JoinColumn(name: "FKCredencial", referencedColumnName: "id", nullable: false)]
  public Credencial $credencial;

  #[ManyToOne(targetEntity: Endereco::class)]
  #[JoinColumn(name: "FKEndereco", referencedColumnName: "id", nullable: true)]
  public ?Endereco $endereco = null;

  #[Column(type: "datetime")]
  public \DateTime $dataCriacao;

  #[Column(type: "datetime", nullable: true)]
  public ?\DateTime $ultimaAtualizacao = null;

  #[Column(type: "string", enumType: "StatusUsuario")]
  public string $statusUsuario = 'ATIVO';

  #[OneToMany(targetEntity: InformacaoContato::class, mappedBy: "usuario")]
  public $informacoesContato;

  #[OneToMany(targetEntity: PublicacaoServico::class, mappedBy: "usuario")]
  public $publicacoesServico;

  #[ManyToMany(targetEntity: PublicacaoServico::class, mappedBy: "usuariosFavoritos")]
  public $servicosFavoritos;

  public function __construct() {
    $this->dataCriacao = new \DateTime();
    $this->informacoesContato = new \Doctrine\Common\Collections\ArrayCollection();
    $this->publicacoesServico = new \Doctrine\Common\Collections\ArrayCollection();
    $this->servicosFavoritos = new \Doctrine\Common\Collections\ArrayCollection();
  }
}
