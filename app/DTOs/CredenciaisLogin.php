<?php
namespace App\DTOs;

use KissPhp\Attributes\Data\Validate;
use App\Validators\{ Password, Email };

class CredenciaisLogin {
  #[Validate(Email::class)]
  public readonly string $email;

  #[Validate(Password::class)]
  public readonly string $senha;
}