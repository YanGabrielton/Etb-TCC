<?php
require '../config/ConexaoBanco.php';

$db = new DataBase();
$conn = $db->getConnection();

$sql = "SELECT u.Nome, u.Foto, u.Cidade, c.Email
        FROM Usuario u
        JOIN Credencial c ON c.ID = u.FKCredencial
        WHERE c.FKNivelAcesso = 2";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . $row['Nome'] . "</h3>";
    echo "<p>Email: " . $row['Email'] . "</p>";
    echo "<p>Cidade: " . $row['Cidade'] . "</p>";
    echo "</div><hr>";
}
