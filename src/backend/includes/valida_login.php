<?php
session_start();
if(!isset($_SESSION["id_usuario"])) {
    echo "<script>
            alert('Você precisa estar logado!');
            location.href = '../index.php';
          </script>";
    exit;
}
?>