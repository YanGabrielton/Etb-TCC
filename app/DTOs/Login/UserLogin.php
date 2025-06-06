<?php
namespace App\DTOs\Login;

use KissPhp\Attributes\Data\Validate;
use App\Validators\{ Password, Email };

class UserLogin {
  #[Validate(Email::class)]
  public string $email;

  #[Validate(Password::class)]
  public string $password;
}