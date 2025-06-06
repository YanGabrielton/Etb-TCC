<?php

namespace App\Utils;

function bp($value) {
  echo "<pre>";
    print_r($value);
  echo "</pre>";
  die();
}