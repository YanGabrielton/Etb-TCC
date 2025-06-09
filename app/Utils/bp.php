<?php

namespace App\Utils;

/**
 * Retorna o conteúdo de uma variável e encerra a execução do script.
 * 
 * @param array|object|string|int|float|bool $value O valor a ser impresso.
 */
function bp(array|object|string|int|float|bool $value): void {
  if (is_array($value) || is_object($value)) {
    echo "<pre>";
      print_r($value);
    echo "</pre>";
  }

  if (is_string($value) || is_int($value) || is_float($value) || is_bool($value)) {
    if (is_bool($value)) $value = $value ? 'TRUE' : 'FALSE';
    echo "
      <p>{$value}</p>
      <br>
    ";
  }

  die();
}