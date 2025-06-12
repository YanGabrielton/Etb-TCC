<?php
namespace App\Entities;

enum StatusUsuario: string {
  case ATIVO = 'ATIVO';
  case INATIVO = 'INATIVO';
  case BLOQUEADO = 'BLOQUEADO';
  case BANIDO = 'BANIDO';
} 