<?php
require '../config/ConexaoBanco.php';

$db = new DataBase();
$conn = $db->getConnection();

$sql = "SELECT ps.Titulo, ps.Sobre, ps.Valor, u.Nome, cs.Nome AS Categoria
        FROM PublicacaoServico ps
        JOIN Usuario u ON ps.FKUsuario = u.ID
        JOIN CategoriaServico cs ON ps.FKCategoria = cs.ID
        WHERE ps.StatusPublicacao = 'ATIVO'";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . $row['Titulo'] . " (" . $row['Categoria'] . ")</h3>";
    echo "<p>Por: " . $row['Nome'] . "</p>";
    echo "<p>Sobre: " . $row['Sobre'] . "</p>";
    echo "<p>R$ " . number_format($row['Valor'], 2, ',', '.') . "</p>";
    echo "</div><hr>";
}
?>
