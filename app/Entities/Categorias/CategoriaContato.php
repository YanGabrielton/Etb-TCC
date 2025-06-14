<?php
namespace App\Entities\Categorias;

use KissPhp\Abstractions\Entity;
use Doctrine\ORM\Mapping as ORM;

use App\Entities\Servico\InformacaoContato;

#[ORM\Entity]
class CategoriaContato extends Entity {
  #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: "integer", name: "ID")]
  private ?int $id = null;

  #[ORM\Column(length: 255, name: "Nome")]
  private string $nome;

  #[ORM\OneToMany(targetEntity: InformacaoContato::class, mappedBy: "categoriaContato")]
  private $informacoesContato;

  public function __construct() {
    $this->informacoesContato = new \Doctrine\Common\Collections\ArrayCollection();
  }
} 