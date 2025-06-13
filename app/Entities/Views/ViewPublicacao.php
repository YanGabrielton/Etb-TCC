<?php

namespace App\Entities\Views;

use KissPhp\Abstractions\Entity;

class ViewPublicacao extends Entity {
    public int $IDPublicacao;
    public string $NomeUsuario;
    public ?string $FotoUsuario;
    public string $Titulo;
    public string $Sobre;
    public float $Valor;
    public int $QuantidadeFavorito;
    public string $PublicadoEm;
    public ?string $EditadoEm;
    public string $Categoria;
    public ?string $Email;
    public ?string $Facebook;
    public ?string $Celular;
    public ?string $Whatsapp;
    public ?string $Instagram;
    public ?string $OutroContato;
} 