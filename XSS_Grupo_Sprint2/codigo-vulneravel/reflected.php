<?php include 'topo.php'; ?>

<h1>Busca de produtos</h1>

<form method="get" action="reflected.php">
    <label>Digite o que procura:</label>
    <input type="text" name="nome" value="" placeholder="ex: fone de ouvido">
    <button type="submit">Buscar</button>
</form>

<?php
// ===============================================================
//  REFLECTED XSS  (ponto de injeção obrigatório #1)
//  O valor vindo da URL (?nome=...) é jogado direto no HTML,
//  SEM nenhuma sanitização. Se o valor contiver <script>, o
//  navegador executa.
// ===============================================================
$nome = $_GET['nome'] ?? '';

if ($nome !== '') {
    // VULNERÁVEL: concatenação direta da entrada do usuário no HTML
    echo "<h2>Resultados para: " . $nome . "</h2>";
    echo "<p>Nenhum produto encontrado para essa busca.</p>";
}
?>

<p class="aviso">💉 <b>Payload de teste:</b>
<code>&lt;script&gt;alert('Reflected XSS')&lt;/script&gt;</code> no campo acima
(ou direto na URL: <code>reflected.php?nome=&lt;script&gt;alert(1)&lt;/script&gt;</code>).</p>

<?php include 'rodape.php'; ?>
