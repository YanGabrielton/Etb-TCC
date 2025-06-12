<?php
session_start();
if(!isset($_SESSION["id_usuario"])) {
    $_SESSION["erro"] = "Você precisa estar logado!";
    header("Location: /src/pages/login.php");
    exit;
}