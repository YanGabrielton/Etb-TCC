<?php
namespace App\Entities\Categorias;

use KissPhp\Abstractions\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use App\Entities\Servico\PublicacaoServico;

#[ORM\Entity, ORM\Table(name:"CategoriaServico")]
class CategoriaServico extends Entity {
  #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: "integer", name: "ID")]
  public ?int $id = null;

  #[ORM\Column(length: 25, name: "Nome")]
  public string $nome;

  #[ORM\OneToMany(targetEntity: PublicacaoServico::class, mappedBy: "categoria")]
  public ArrayCollection $publicacoesServico;

  public function __construct() {
    $this->publicacoesServico = new ArrayCollection();
  }
} 