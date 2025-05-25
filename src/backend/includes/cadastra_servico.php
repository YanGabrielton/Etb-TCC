<?php
session_start();
require '../config/DataBase.php';
include "../../includes/valida_login.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $categoria = $_POST["categoria"];
    $id_usuario = $_SESSION["id_usuario"];
    
    // Upload da imagem como no exemplo dos amplificadores
    $foto_nome = "";
    if(!empty($_FILES["foto"]["name"])) {
        $foto_nome = "img/servicos/".$_FILES["foto"]["name"];
        move_uploaded_file($_FILES["foto"]["tmp_name"], "../../".$foto_nome);
    }

    $sql = "INSERT INTO PublicacaoServico (Titulo, Sobre, Valor, FKCategoria, FKUsuario) 
            VALUES ('$titulo', '$descricao', '$preco', '$categoria', '$id_usuario')";
    
    if(mysqli_query($conectar, $sql)) {
        echo "<script>
                alert('Serviço cadastrado com sucesso!');
                location.href='buscar.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao cadastrar serviço!');
                history.back();
              </script>";
    }
}
