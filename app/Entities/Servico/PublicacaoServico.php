<?php
namespace App\Entities\Servico;

use Doctrine\ORM\Mapping as ORM;
use KissPhp\Abstractions\Entity;

use App\Entities\Usuarios\Usuario;
use App\Entities\Status\StatusPublicacao;
use App\Entities\Categorias\CategoriaServico;

#[Entity]
class PublicacaoServico extends Entity {
  #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: "integer")]
  public ?int $id = null;

  #[ORM\Column(length: 50)]
  public string $titulo;

  #[ORM\Column(length: 255, nullable: true)]
  public ?string $sobre = null;

  #[ORM\Column(type: "decimal", precision: 7, scale: 2)]
  public float $valor;

  #[ORM\Column(type: "integer")]
  public int $quantidadeFavorito = 0;

  #[ORM\ManyToOne(targetEntity: CategoriaServico::class)]
  #[ORM\JoinColumn(name: "FKCategoria", referencedColumnName: "id", nullable: false)]
  public CategoriaServico $categoria;

  #[ORM\ManyToOne(targetEntity: Usuario::class)]
  #[ORM\JoinColumn(name: "FKUsuario", referencedColumnName: "id", nullable: false)]
  public Usuario $usuario;

  #[ORM\Column(type: "datetime")]
  public \DateTime $dataCriacao;

  #[ORM\Column(type: "datetime", nullable: true)]
  public ?\DateTime $ultimaAtualizacao = null;

  #[ORM\Column(type: "string", enumType: StatusPublicacao::class)]
  public string $statusPublicacao = 'EM_ANALISE';

  #[ORM\ManyToMany(targetEntity: Usuario::class, inversedBy: "servicosFavoritos")]
  #[ORM\JoinTable(name: "ServicoFavorito",
    joinColumns: [new ORM\JoinColumn(name: "IDServico", referencedColumnName: "id")],
    inverseJoinColumns: [new ORM\JoinColumn(name: "IDUsuario", referencedColumnName: "id")]
  )]
  public $usuariosFavoritos;

  #[ORM\OneToMany(targetEntity: AvaliacaoServico::class, mappedBy: "publicacao")]
  public $avaliacoes;

  public function __construct() {
    $this->dataCriacao = new \DateTime();
    $this->usuariosFavoritos = new \Doctrine\Common\Collections\ArrayCollection();
    $this->avaliacoes = new \Doctrine\Common\Collections\ArrayCollection();
  }
} 