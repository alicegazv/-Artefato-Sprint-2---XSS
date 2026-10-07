<?php
include 'db.php';
include 'topo.php';

// ===============================================================
//  STORED XSS — CORRIGIDO
//  Técnica de defesa diferente da do Reflected:
//   (a) PREPARED STATEMENTS ao salvar  -> impede SQL Injection e
//       trata a entrada como dado, não como comando;
//   (b) htmlspecialchars() ao EXIBIR   -> impede que o conteúdo
//       salvo seja interpretado como HTML/script.
// ===============================================================

// 1) Salvar comentário com prepared statement
if (isset($_POST['texto']) && trim($_POST['texto']) !== '') {
    $autor = $_POST['autor'] ?? 'Anônimo';
    $texto = $_POST['texto'];

    // SEGURO: a entrada vai como parâmetro (?), nunca concatenada
    $stmt = $conn->prepare("INSERT INTO comentarios (autor, texto) VALUES (?, ?)");
    $stmt->bind_param("ss", $autor, $texto);
    $stmt->execute();
    $stmt->close();
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
// 2) Exibir comentários COM escape
$resultado = $conn->query("SELECT autor, texto, data_criacao FROM comentarios ORDER BY id DESC");
while ($row = $resultado->fetch_assoc()) {
    // SEGURO: escapa tudo que veio do banco antes de imprimir
    $autor = htmlspecialchars($row['autor'], ENT_QUOTES, 'UTF-8');
    $texto = htmlspecialchars($row['texto'], ENT_QUOTES, 'UTF-8');
    $data  = htmlspecialchars($row['data_criacao'], ENT_QUOTES, 'UTF-8');

    echo '<div class="comentario">';
    echo '<span class="autor">' . $autor . '</span> ';
    echo '<small>(' . $data . ')</small>';
    echo '<p>' . $texto . '</p>';
    echo '</div>';
}
?>

<p class="aviso">✅ Reenvie o payload <code>&lt;script&gt;alert('Stored XSS')&lt;/script&gt;</code>:
ele fica salvo, mas ao ser exibido aparece como texto. E o payload de roubo de
cookie falha duas vezes — o cookie agora é <b>HttpOnly</b> e a <b>CSP</b> bloqueia o script.</p>

<?php include 'rodape.php'; ?>
