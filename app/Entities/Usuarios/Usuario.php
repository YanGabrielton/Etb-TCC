<?php
namespace App\Entities\Usuarios;

use KissPhp\Abstractions\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use App\Entities\Status\StatusUsuario;
use App\Entities\Servico\{ InformacaoContato, PublicacaoServico };

#[ORM\Entity]
class Usuario extends Entity {
  #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: "integer")]
  public ?int $id = null;

  #[ORM\Column(length: 50)]
  public string $nome;

  #[ORM\Column(length: 11, unique: true)]
  public string $cpf;

  #[ORM\Column(length: 255, nullable: true)]
  public ?string $foto = null;

  #[ORM\Column(length: 11, nullable: true)]
  public ?string $celular = null;

  #[ORM\Column(type: "date")]
  public \DateTime $dataNascimento;

  #[ORM\ManyToOne(targetEntity: Credencial::class)]
  #[ORM\JoinColumn(name: "FKCredencial", referencedColumnName: "id", nullable: false)]
  public Credencial $credencial;

  #[ORM\ManyToOne(targetEntity: Endereco::class)]
  #[ORM\JoinColumn(name: "FKEndereco", referencedColumnName: "id", nullable: true)]
  public ?Endereco $endereco = null;

  #[ORM\Column(type: "datetime")]
  public \DateTime $dataCriacao;

  #[ORM\Column(type: "datetime", nullable: true)]
  public ?\DateTime $ultimaAtualizacao = null;

  #[ORM\Column(type: "string", enumType: StatusUsuario::class)]
  public string $statusUsuario = 'ATIVO';

  #[ORM\OneToMany(targetEntity: InformacaoContato::class, mappedBy: "usuario")]
  public $informacoesContato;

  #[ORM\OneToMany(targetEntity: PublicacaoServico::class, mappedBy: "usuario")]
  public $publicacoesServico;

  #[ORM\ManyToMany(targetEntity: PublicacaoServico::class, mappedBy: "usuariosFavoritos")]
  public $servicosFavoritos;

  public function __construct() {
    $this->dataCriacao = new \DateTime();
    $this->informacoesContato = new ArrayCollection();
    $this->publicacoesServico = new ArrayCollection();
    $this->servicosFavoritos = new ArrayCollection();
  }
}
