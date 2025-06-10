<?php
namespace App\Validators;

use KissPhp\Abstractions\DataValidator;

class Descricao extends DataValidator {
  public function __construct(private string $descricao) { }

  public function check(): array {
    return $this->newValidate()
      ->whenNot(strlen($this->descricao) >= 10 && strlen($this->descricao) <= 1000)
      ->notify('A descrição deve ter entre 10 e 1000 caracteres.')
      ->result();
  }
}