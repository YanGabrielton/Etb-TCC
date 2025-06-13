<?php
namespace App\Entities\Servico;

use KissPhp\Abstractions\Entity;
use Doctrine\ORM\Mapping as ORM;

use App\Entities\Usuarios\Usuario;
use App\Entities\Categorias\CategoriaContato;

#[ORM\Entity]
class InformacaoContato extends Entity {
  #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: "integer")]
  public ?int $id = null;

  #[ORM\Column(length: 255, nullable: true)]
  public ?string $contato = null;

  #[ORM\ManyToOne(targetEntity: Usuario::class)]
  #[ORM\JoinColumn(name: "FKUsuario", referencedColumnName: "id", nullable: false)]
  public Usuario $usuario;

  #[ORM\ManyToOne(targetEntity: CategoriaContato::class)]
  #[ORM\JoinColumn(name: "FKCategoriaContato", referencedColumnName: "id", nullable: false)]
  public CategoriaContato $categoriaContato;
} 