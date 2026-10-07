<?php
// ===============================================================
//  Conexão com o banco de dados (app VULNERÁVEL)
//  XAMPP padrão: host=localhost, usuário=root, senha vazia
// ===============================================================
$conn = new mysqli("localhost", "root", "", "app_xss");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
