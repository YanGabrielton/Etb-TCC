<?php

namespace App\Entities\Views;

use KissPhp\Abstractions\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'ViewPublicacao')]
class ViewPublicacao extends Entity {
    #[ORM\Id]
    #[ORM\Column(type: "integer", name: "IDPublicacao")]
    public int $IDPublicacao;

    #[ORM\Column(type: "string", length: 50, name: "NomeUsuario")]
    public string $NomeUsuario;

    #[ORM\Column(type: "string", length: 255, nullable: true, name: "FotoUsuario")]
    public ?string $FotoUsuario;

    #[ORM\Column(type: "string", length: 50, name: "Titulo")]
    public string $Titulo;

    #[ORM\Column(type: "string", length: 255, nullable: true, name: "Sobre")]
    public string $Sobre;

    #[ORM\Column(type: "decimal", precision: 7, scale: 2, name: "Valor")]
    public float $Valor;

    #[ORM\Column(type: "integer", name: "QuantidadeFavorito")]
    public int $QuantidadeFavorito;

    #[ORM\Column(type: "datetime", name: "PublicadoEm")]
    public string $PublicadoEm;

    #[ORM\Column(type: "datetime", nullable: true, name: "EditadoEm")]
    public ?string $EditadoEm;

    #[ORM\Column(type: "string", length: 25, name: "Categoria")]
    public string $Categoria;

    #[ORM\Column(type: "string", length: 255, nullable: true, name: "Email")]
    public ?string $Email;

    #[ORM\Column(type: "string", length: 255, nullable: true, name: "Facebook")]
    public ?string $Facebook;

    #[ORM\Column(type: "string", length: 11, nullable: true, name: "Celular")]
    public ?string $Celular;

    #[ORM\Column(type: "string", length: 255, nullable: true, name: "Whatsapp")]
    public ?string $Whatsapp;

    #[ORM\Column(type: "string", length: 255, nullable: true, name: "Instagram")]
    public ?string $Instagram;

    #[ORM\Column(type: "string", length: 255, nullable: true, name: "OutroContato")]
    public ?string $OutroContato;
} 