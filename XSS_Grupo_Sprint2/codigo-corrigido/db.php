<?php
// ===============================================================
//  Conexão com o banco de dados (app CORRIGIDA)
//  Mesma conexão da versão vulnerável — a diferença está em
//  COMO os dados são salvos e exibidos (ver comentarios.php).
// ===============================================================
$conn = new mysqli("localhost", "root", "", "app_xss");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
