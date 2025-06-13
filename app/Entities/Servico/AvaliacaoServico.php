<?php
namespace App\Entities\Servico;

use KissPhp\Abstractions\Entity;
use Doctrine\ORM\Mapping as ORM;

use App\Entities\Usuarios\Usuario;

#[ORM\Entity]
class AvaliacaoServico extends Entity {
  #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: "integer")]
  public ?int $id = null;

  #[ORM\Column(type: "integer")]
  public int $nota = 0;

  #[ORM\Column(length: 255, nullable: true)]
  public ?string $comentario = null;

  #[ORM\ManyToOne(targetEntity: PublicacaoServico::class)]
  #[ORM\JoinColumn(name: "FkPublicacao", referencedColumnName: "id", nullable: false)]
  public PublicacaoServico $publicacao;

  #[ORM\ManyToOne(targetEntity: Usuario::class)]
  #[ORM\JoinColumn(name: "FKUsuario", referencedColumnName: "id", nullable: false)]
  public Usuario $usuario;

  #[ORM\Column(type: "datetime")]
  public \DateTime $dataCriacao;

  #[ORM\Column(type: "datetime", nullable: true)]
  public ?\DateTime $ultimaAtualizacao = null;

  public function __construct() {
    $this->dataCriacao = new \DateTime();
  }
} 