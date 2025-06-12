<?php
namespace App\Entities;

enum StatusPublicacao: string {
  case ATIVO = 'ATIVO';
  case EM_ANALISE = 'EM_ANALISE';
  case REJEITADO = 'REJEITADO';
  case BLOQUEADO = 'BLOQUEADO';
} 