<?php
include "../config/ConexaoBanco.php";
include "../../includes/valida_login.php";

$sql = "SELECT ps.ID, ps.Titulo, ps.Sobre, ps.Valor, cs.Nome as Categoria
        FROM PublicacaoServico ps
        JOIN CategoriaServico cs ON cs.ID = ps.FKCategoria
        WHERE ps.StatusPublicacao = 'ATIVO'";
$resultado = mysqli_query($conectar, $sql);
?>