<?php

class env
{
  /**
  * Obtém o valor de uma chave do array $_ENV
  * @param string $key A chave a ser obtida
  * @return mixed O valor da chave
  */
  public static function get(string $key): mixed
  {
    return $_ENV[$key];
  }

  /**
  * Define o valor de uma chave no array $_ENV
  * @param string $key A chave a ser definida
  * @param string $value O valor a ser definido
  */
  public static function set(string $key, string $value): void
  {
    $_ENV[$key] = $value;
  }

  /**
  * Carrega as variáveis de ambiente do arquivo .env
  * @param string $path O caminho para o arquivo .env
  */
  public static function load(string $path): void
  {
    if (!file_exists($path)) return;

    $linhas = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($linhas as $linha) {
      // Ignora as linhas que começam com #
      if (strpos(trim($linha), '#') === 0)
        continue;

      if (strpos($linha, '=')) {
        [$chave, $valor] = explode('=', $linha, 2);
        $chave = trim($chave);
        $valor = trim($valor);
        // Insere a chave e o valor no array $_ENV
        self::set($chave, $valor);
      }
    }
  }
}