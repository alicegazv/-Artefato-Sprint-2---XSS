<?php include 'topo.php'; ?>

<h1>Busca de produtos</h1>

<form method="get" action="reflected.php">
    <label>Digite o que procura:</label>
    <input type="text" name="nome" value="" placeholder="ex: fone de ouvido">
    <button type="submit">Buscar</button>
</form>

<?php
// ===============================================================
//  REFLECTED XSS — CORRIGIDO com output encoding
//  htmlspecialchars() converte < > " ' & em entidades HTML
//  (&lt; &gt; ...), então o navegador mostra o texto em vez de
//  interpretá-lo como tag/script.
// ===============================================================
$nome = $_GET['nome'] ?? '';

if ($nome !== '') {
    // SEGURO: escapa os caracteres especiais antes de imprimir
    $nome_seguro = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
    echo "<h2>Resultados para: " . $nome_seguro . "</h2>";
    echo "<p>Nenhum produto encontrado para essa busca.</p>";
}
?>

<p class="aviso">✅ Teste o payload <code>&lt;script&gt;alert('XSS')&lt;/script&gt;</code>:
ele aparece como <b>texto literal</b> na página — o <code>htmlspecialchars()</code>
neutralizou a tag.</p>

<?php include 'rodape.php'; ?>
